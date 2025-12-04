import React, { createContext, useState, useEffect } from "react";

// Create Context
export const UserContext = createContext();

// Provider Component
export const UserProvider = ({ children }) => {
  const [userType, setUserType] = useState(null); //Add User Type
  const [userId, setUserId] = useState(null); //Add UserID
  const [userName, setUserName] = useState(null); //Add UserName
  const [userEmail, setUserEmail] = useState(null); //Add Email
  const [userPassword, setUserPassword] = useState(null); // Add password

  useEffect(() => {
    const storedUserId = sessionStorage.getItem("user_id");
    const storedUserType = sessionStorage.getItem("role");
    const storedUserName = sessionStorage.getItem("name");
    const storedUserEmail = sessionStorage.getItem("email");
    const storedUserPassword = sessionStorage.getItem("password");

    if (storedUserType) setUserType(storedUserType); // Set User Type
    if (storedUserId) setUserId(storedUserId); // Set UserID
    if (storedUserName) setUserName(storedUserName); // Set User Name
    if (storedUserEmail) setUserEmail(storedUserEmail); // Set Email
    if (storedUserPassword) setUserPassword(storedUserPassword); // Set Password
  }, []);

  useEffect(() => {
    if (userType) sessionStorage.setItem("role", userType); // Persist User Type
    else sessionStorage.removeItem("role");

    if (userId) sessionStorage.setItem("user_id", userId); // Persist UserID
    else sessionStorage.removeItem("user_id");

    if (userName) sessionStorage.setItem("name", userName); // Persist UserName
    else sessionStorage.removeItem("name");

    if (userEmail) sessionStorage.setItem("email", userEmail); // Persist Email
    else sessionStorage.removeItem("email");

    if (userPassword) sessionStorage.setItem("password", userPassword); // Persist Password
    else sessionStorage.removeItem("password");
  }, [userType, userId, userName, userEmail, userPassword]);

  // Function To Update User Context
  const setUserContext = ({ userId, userName, userEmail, userPassword }) => {
    setUserId(userId);
    setUserName(userName);
    setUserEmail(userEmail);
    setUserPassword(userPassword);
  };

  return (
    <UserContext.Provider
      value={{
        userType,
        setUserType,
        userId,
        setUserId,
        userName,
        setUserName,
        userEmail,
        setUserEmail,
        userPassword,
        setUserPassword,
        setUserContext,  // Provide setUserContext
      }}
    >
      {children}
    </UserContext.Provider>
  );
};