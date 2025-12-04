const express = require("express");
const mysql = require("mysql");
const cors = require("cors");
const path = require("path");

const app = express();

app.use(cors());
app.use(express.json());
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "food_donation_db"
})

// Connecting To The Database
db.connect((err) => {
    if (err) { console.error("Database Connection Failed : ", err); } 
    else { app.listen(5000, () => { console.log(`Server Running On http://localhost:5000`) } ) };
    }
)

// Create An Account
app.post('/register', (req, res) => {
    console.log("Received Signup Request");
    console.log("Request Body : ", req.body);
    const { name, email, password, address, phone } = req.body;
    // Basic validation
    if (!name || !email || !password || !address || !phone) {
        return res.status(400).json({ message: "All fields are required." });
    }
    // Check if email already exists
    const checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    db.query(checkEmailQuery, [email], (err, results) => {
        if (err) {
            console.error("Error Checking Email :", err);
            return res.status(500).json({ message: "Database Error" });
        }
        if (results.length > 0) {
            return res.status(400).json({ message: "The Email You Put Is Currently Used By Another Account !!!" });
        }
        // Insert new user with default role 'provider'
        const insertUserQuery = `
            INSERT INTO users (name, email, password, role, address, phone)
            VALUES (?, ?, ?, 'provider', ?, ?)
        `;
        db.query(insertUserQuery, [name, email, password, address, phone], (err, result) => {
            if (err) {
                console.error("Error Inserting Data :", err);
                return res.status(500).json({ message: "Error Inserting Data" });
            }
            console.log("User Registered Successfully :", result);
            return res.status(201).json({ message: "User Registered Successfully" });
        });
    });
});

// Sign-In
app.post('/signin', (req, res) => {
    const { email, password } = req.body;

    const emailCheckQuery = "SELECT * FROM users WHERE email = ?";
    db.query(emailCheckQuery, [email], (err, emailResult) => {
        if (err) {
            console.error("Database Error : ", err);
            return res.status(500).json({ message: "Server Error" });
        }

        if (emailResult.length === 0) {
            return res.status(404).json({ message: "Email not found" });
        }

        const passwordCheckQuery = "SELECT * FROM users WHERE email = ? AND password = ?";
        db.query(passwordCheckQuery, [email, password], (err, passwordResult) => {
            if (err) {
                console.error("Database Error : ", err);
                return res.status(500).json({ message: "Server Error" });
            }

            if (passwordResult.length === 0) {
                return res.status(401).json({ message: "Incorrect Password" });
            }

            const user = passwordResult[0];
            return res.status(200).json({
                message: "Success",
                role: user.role,
                name: user.name,
                user_id: user.user_id,
                email: user.email,
                password: user.password,
            });
        });
    });
});

// List Of Foods ( Admin )
app.get("/admin/foods", (req, res) => {
    const query = "SELECT * FROM foods ORDER BY created_at DESC";
    db.query(query, (err, results) => {
        if (err) return res.status(500).json({ message: "Error Fetching Foods" });
        res.status(200).json(results);
    });
});

// Add Food ( Admin )
app.post("/admin/foods/add", (req, res) => {
    const { name, quantity, expiryDate, foodStatus, sortDate, providerId } = req.body;

    const query = `
        INSERT INTO foods (name, quantity, expiry_date, food_status, sort_date, provider_id)
        VALUES (?, ?, ?, ?, ?, ?)
    `;

    db.query(query, [name, quantity, expiryDate, foodStatus, sortDate, providerId], (err, result) => {
        if (err) {
            console.error("Error adding food:", err);
            return res.status(500).json({ message: "Error adding food" });
        }
        res.status(200).json({ message: "Food added successfully", foodId: result.insertId });
    });
});

// Edit Selected Food ( Admin )
app.put("/admin/foods/edit", (req, res) => {
    const { foodId, name, quantity, expiryDate, foodStatus, sortDate } = req.body;

    const query = `
        UPDATE foods
        SET name = ?, quantity = ?, expiry_date = ?, food_status = ?, sort_date = ?
        WHERE food_id = ?
    `;

    db.query(query, [name, quantity, expiryDate, foodStatus, sortDate, foodId], (err, result) => {
        if (err) {
            console.error("Error updating food:", err);
            return res.status(500).json({ message: "Error updating food" });
        }
        res.status(200).json({ message: "Food updated successfully" });
    });
});

// Delete Selected Food ( Admin );  
app.post('/admin/foods/delete', (req, res) => {
    const { id } = req.body;
    const query = `DELETE FROM foods WHERE food_id = ?`;    
    db.query(query, [id], (err, result) => {
        if (err) {
            console.error("Error Deleting Food : ", err);
            return res.status(500).json({ message: "Error Deleting Food" });
        }
        res.status(200).json({ message: "Food Deleted Successfully" });
    });
});

// List Of Providers ( Admin )
app.get("/admin/providers", (req, res) => {
    const query = "SELECT * FROM users WHERE role = 'provider' ORDER BY created_at DESC";
    db.query(query, (err, results) => {
        if (err) return res.status(500).json({ message: "Error Fetching Providers" });
        res.status(200).json(results);
    });
});

// Add A Provider ( Admin )
app.post("/admin/providers/add", (req, res) => {
    const { name, email, password, role = 'provider', address, phone } = req.body;
    const query = `
        INSERT INTO users (name, email, password, role, address, phone)
        VALUES (?, ?, ?, ?, ?, ?)
    `;
    db.query(query, [name, email, password, role, address, phone], (err, result) => {
        if (err) {
            console.error("Error adding provider:", err);
            return res.status(500).json({ message: "Error adding provider" });
        }
        res.status(200).json({ 
            message: "Provider added successfully", 
            provider: {
                user_id: result.insertId,
                name,
                email,
                role,
                address,
                phone
            }
        });
    });
});

// Edit Selected Provider ( Admin )
app.put("/admin/providers/edit", (req, res) => {
    const { userId, name, email, password, address, phone } = req.body;
    const query = `
        UPDATE users
        SET name = ?, email = ?, password = ?, address = ?, phone = ?
        WHERE user_id = ? AND role = 'provider'
    `;
    db.query(query, [name, email, password, address, phone, userId], (err, result) => {
        if (err) {
            console.error("Error updating provider:", err);
            return res.status(500).json({ message: "Error updating provider" });
        }
        res.status(200).json({ message: "Provider updated successfully" });
    });
});

// Delete Selected Provider ( Admin ) 
app.post('/admin/providers/delete', (req, res) => {
    const { id } = req.body;
    const query = `DELETE FROM users WHERE user_id = ? AND role = 'provider'`;
    db.query(query, [id], (err, result) => {
        if (err) {
            console.error("Error Deleting Provider:", err);
            return res.status(500).json({ message: "Error Deleting Provider" });
        }
        res.status(200).json({ message: "Provider Deleted Successfully" });
    });
});

// List Of Associations ( Admin )
app.get("/admin/associations", (req, res) => {
    const query = "SELECT * FROM users WHERE role = 'association' ORDER BY created_at DESC";
    db.query(query, (err, results) => {
        if (err) return res.status(500).json({ message: "Error Fetching Associations" });
        res.status(200).json(results);
    });
});

// Add An Association ( Admin )
app.post("/admin/associations/add", (req, res) => {
    const { name, email, password, role = 'association', address, phone } = req.body;
    const query = `
        INSERT INTO users (name, email, password, role, address, phone)
        VALUES (?, ?, ?, ?, ?, ?)
    `;
    db.query(query, [name, email, password, role, address, phone], (err, result) => {
        if (err) {
            console.error("Error adding association:", err);
            return res.status(500).json({ message: "Error adding association" });
        }
        res.status(200).json({ 
            message: "Association added successfully", 
            association: {
                user_id: result.insertId,
                name,
                email,
                role,
                address,
                phone
            }
        });
    });
});

// Edit Selected Associations ( Admin )
app.put("/admin/associations/edit", (req, res) => {
    const { userId, name, email, password, address, phone } = req.body;
    const query = `
        UPDATE users
        SET name = ?, email = ?, password = ?, address = ?, phone = ?
        WHERE user_id = ? AND role = 'associations'
    `;
    db.query(query, [name, email, password, address, phone, userId], (err, result) => {
        if (err) {
            console.error("Error updating association:", err);
            return res.status(500).json({ message: "Error updating association" });
        }
        res.status(200).json({ message: "Association updated successfully" });
    });
});

// Delete Selected Associations ( Admin ) 
app.post('/admin/associations/delete', (req, res) => {
    const { id } = req.body;
    const query = `DELETE FROM users WHERE user_id = ? AND role = 'association'`;
    db.query(query, [id], (err, result) => {
        if (err) {
            console.error("Error Deleting Association : ", err);
            return res.status(500).json({ message: "Error Deleting Association" });
        }
        res.status(200).json({ message: "Association Deleted Successfully" });
    });
});


// 📦 Get All Foods by Provider
app.get('/foods/:provider_id', (req, res) => {
    const { provider_id } = req.params;
    db.query("SELECT * FROM foods WHERE provider_id = ?", [provider_id], (err, results) => {
        if (err) return res.status(500).json({ message: "DB Error" });
        res.status(200).json(results);
    });
});

// ➕ Add New Food
app.post('/foods', (req, res) => {
    const { name, ingredients, quantity, expiryDate, sortDate, provider_id } = req.body;
    const sql = `INSERT INTO foods (name, quantity, expiry_date, sort_date, provider_id) VALUES (?, ?, ?, ?, ?)`;
    db.query(sql, [name, quantity, expiryDate, sortDate, provider_id], (err, result) => {
        if (err) return res.status(500).json({ message: "Insert Error" });
        res.status(201).json({ message: "Food added", food_id: result.insertId });
    });
});

// 🗑 Delete Food
app.delete('/foods/:id', (req, res) => {
    db.query("DELETE FROM foods WHERE food_id = ?", [req.params.id], (err) => {
        if (err) return res.status(500).json({ message: "Delete Error" });
        res.status(200).json({ message: "Food deleted" });
    });
});

// ✏️ Update Food
app.put('/foods/:id', (req, res) => {
    const { name, quantity, expiryDate, sortDate } = req.body;
    const sql = `
        UPDATE foods
        SET name = ?, quantity = ?, expiry_date = ?, sort_date = ?
        WHERE food_id = ?
    `;
    db.query(sql, [name, quantity, expiryDate, sortDate, req.params.id], (err) => {
        if (err) return res.status(500).json({ message: "Update Error" });
        res.status(200).json({ message: "Food updated" });
    });
});


// Get Provider Info
app.get('/providers/:id', (req, res) => {
    const { id } = req.params;
    db.query("SELECT * FROM providers WHERE provider_id = ?", [id], (err, results) => {
        if (err) return res.status(500).json({ message: "DB Error" });
        if (results.length === 0) return res.status(404).json({ message: "Provider not found" });
        res.status(200).json(results[0]);
    });
});

// Update Provider Info
app.put('/providers/:id', (req, res) => {
    const { id } = req.params;
    const { cin, name, email, phone, password } = req.body;
    
    // You should hash the password before updating if it's changed
    const sql = `
        UPDATE providers
        SET cin = ?, name = ?, email = ?, phone = ?, password = ?
        WHERE provider_id = ?
    `;
    
    db.query(sql, [cin, name, email, phone, password, id], (err) => {
        if (err) return res.status(500).json({ message: "Update Error" });
        res.status(200).json({ message: "Provider updated" });
    });
});