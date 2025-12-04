import React, { useState } from 'react';
import './Select.css'
function Select() {
  const [selectOption, setSelectOption] = useState('');

  return (
    <div>
      <h1>Select options:</h1>
      <select onChange={(event) => setSelectOption(event.target.value)}>
      <option value="" isChecked> Chaissir</option>
        <option value="react">React</option>
        <option value="angular">Angular</option>
        <option value="vuejs">Vue.js</option>
      </select>
      <h3>Vous avez choisi : {selectOption}</h3>
    </div>
  );
}

export default Select;
