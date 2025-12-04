// src/data/AssociationData.js

export const associationInfo = {
    cin: '123456',
    name: 'Green Earth Association',
    email: 'association@gmail.com',
    telephone: '123-456-7890',
    password: '********',
  };
  
  export const donations = [
    {
      _id: 1,
      name: 'Alice',
      amount: 100,
      date: '2023-10-10',
    },
    {
      _id: 2,
      name: 'Bob',
      amount: 200,
      date: '2023-10-15',
    },
    {
        _id: 3,
        name: 'Raslen',
        amount: 2000,
        date: '2025-02-15',
    },
  ];
  
  export const foodList = [
    {
      _id: 1,
      name: 'Apple',
      ingredients: 'Fruit',
      quantity: 10,
      sortDate: '2023-10-01',
      expiryDate: '2023-10-15',
      status: 'Fresh',
      donated: 0,
      donor: 'Local Farm',
    },
    {
      _id: 2,
      name: 'Bread',
      ingredients: 'Flour, Water, Yeast',
      quantity: 5,
      sortDate: '2023-10-05',
      expiryDate: '2023-10-20',
      status: 'Expired',
      donated: 0,
      donor: 'Bakery Shop',
    },
    {
      _id: 3,
      name: 'Carrot',
      ingredients: 'Vegetable',
      quantity: 15,
      sortDate: '2023-10-10',
      expiryDate: '2023-10-25',
      status: 'Fresh',
      donated: 0,
      donor: 'Local Farm',
    },
  ];
  
