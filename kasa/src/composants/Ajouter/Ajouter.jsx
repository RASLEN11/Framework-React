import React, { useState } from "react";
import "./Ajouter.css";

function Ajouter() {
  const [tasks, setTasks] = useState([]);
  const [newTask, setNewTask] = useState("");

  const addTask = () => {
    if (newTask.trim() !== "") {
      setTasks([...tasks, { text: newTask, completed: false }]);
      setNewTask("");
    }
  };

  const toggleCompletion = (index) => {
    const updatedTasks = tasks.map((task, i) =>
      i === index ? { ...task, completed: !task.completed } : task
    );
    setTasks(updatedTasks);
  };

  const deleteTask = (index) => {
    const updatedTasks = tasks.filter((_, i) => i !== index);
    setTasks(updatedTasks);
  };

  return (
    <div className="todo-container">
      <h2>Ajouter List</h2>
      <div className="todo-input-container">
        <input
          type="text"
          value={newTask}
          onChange={(e) => setNewTask(e.target.value)}
          placeholder="Donner un txte"
        />
        <button onClick={addTask}>Ajouter</button>
      </div>
      <ul className="todo-list">
        {tasks.map((task, index) => (
          <li key={index}>
            <div>
              <label className="task-item">
                <input
                  type="checkbox"
                  checked={task.completed}
                  onChange={() => toggleCompletion(index)}
                />
                <span className={task.completed ? "completed" : ""}>
                  {task.text}
                </span>
              </label>
              {task.completed && (
                <button onClick={() => deleteTask(index)}>Supprimer</button>
              )}
            </div>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default Ajouter;
