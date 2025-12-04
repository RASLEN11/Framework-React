import React, { useState } from 'react';
import './Color.css';

function Color() {
    const [selectedColor, setSelectedColor] = useState('');
  const [backgroundColor, setBackgroundColor] = useState('#282c34');

  const colors = [
    { name: 'White', hex: '#FFFFFF' },
    { name: 'Red', hex: '#FF5733' },
    { name: 'Green', hex: '#28A745' },
    { name: 'Blue', hex: '#007BFF' },
    { name: 'Yellow', hex: '#FFC107' },
    { name: 'Purple', hex: '#6F42C1' },
    { name: 'Orange', hex: '#FF7F50' },
  ];

  const handleColorClick = (hex) => {
    setSelectedColor(hex);
    setBackgroundColor(hex);
  };

  return (
    <div className="color-container">
      <h3 className="selected-color">
          You selected: <span style={{ color: selectedColor }}>{selectedColor}</span>
        </h3>
      <div className="color-palette">
        {colors.map((color) => (
          <div
            key={color.name}
            className="color-box"
            style={{ backgroundColor: color.hex }}
            onClick={() => handleColorClick(color.hex)}
          />
        ))}
      </div>

      <div 
        className="color-display" 
        style={{ backgroundColor: backgroundColor }}
      >
      </div>
    </div>
  );
}

export default Color;
