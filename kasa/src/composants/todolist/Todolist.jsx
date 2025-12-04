import React, { useState } from "react";
import "./Ajouter.css";

function Ajouter() {
  const [tasks, setTasks] = useState([]);
  const [newTask, setNewTask] = useState("");
  const [isEditing, setIsEditing] = useState(null);
  const [editText, setEditText] = useState("");

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

  const editTask = (index) => {
    setIsEditing(index);
    setEditText(tasks[index].text);
  };

  const saveEdit = (index) => {
    const updatedTasks = tasks.map((task, i) =>
      i === index ? { ...task, text: editText } : task
    );
    setTasks(updatedTasks);
    setIsEditing(null);
    setEditText("");
  };

  return (
    <div className="todo-container">
      <h2>To-Do List</h2>
      <div className="todo-input-container">
        <input
          type="text"
          value={newTask}
          onChange={(e) => setNewTask(e.target.value)}
          placeholder="Nouvelle Tâche"
        />
        <button onClick={addTask}>Ajouter</button>
      </div>
      <ul className="todo-list">
        {tasks.map((task, index) => (
          <li key={index}>
            <div>
              {isEditing === index ? (
                <>
                  <input
                    type="text"
                    value={editText}
                    onChange={(e) => setEditText(e.target.value)}
                  />
                  <button onClick={() => saveEdit(index)}>Enregistrer</button>
                </>
              ) : (
                <>
                  <input
                    type="checkbox"
                    checked={task.completed}
                    onChange={() => toggleCompletion(index)}
                  />
                  <span className={task.completed ? "completed" : ""}>
                    {task.text}
                  </span>
                  <button onClick={() => editTask(index)}>Modifier</button>
                </>
              )}
            </div>
            <button onClick={() => deleteTask(index)}>Supprimer</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default Ajouter;
