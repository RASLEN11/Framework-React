import React, { useState } from 'react';
import './Checkbox.css'
function CheckboxToggle() {
  const [isChecked, setIsChecked] = useState(false);
  const [isChecked1, setIsChecked1] = useState(false);

  return (
    <>
    <div>
      <label>
        Cocher{' '}
        <input type="checkbox" onChange={(change) => setIsChecked(change.target.checked)} />
        <span>{isChecked && <p> welcome to our web site test </p>}</span>
      </label>
    </div>
    <div>
    <label>
      Cocher{' '}
      <input type="checkbox" onChange={(change1) => setIsChecked1(change1.target.checked)} />
      <span>{isChecked1 && <p> DICTATORS FTW </p>}</span>
    </label>
  </div>
    </>
  );
}
export default CheckboxToggle;
