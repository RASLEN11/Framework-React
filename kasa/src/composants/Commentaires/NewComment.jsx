import React, { useState } from 'react';

const NewComment = (props) => {
  const [newCom, setNewCom] = useState('');

  return (
    <div className="new-comment">
      <div className="profile-pic"></div>
      <div className="textarea-container">
        <textarea
          placeholder="Écrire un commentaire..."
          value={newCom}
          onChange={(event) => setNewCom(event.target.value)}
        ></textarea>
      </div>
      <div className="icons-box">
        <i className="fa-regular fa-image"></i>
        <i className="fa-regular fa-face-smile"></i>
        <i className="fa-solid fa-camera"></i>
      </div>
      <i
        className="fa-solid fa-paper-plane send-icon"
        style={{ cursor: 'pointer' }}
        onClick={() => {
          const today = new Date();
          const formattedDate = `${today.getDate()}/${
            today.getMonth() + 1
          }/${today.getFullYear()}`;
          props.addComment({
            img: 'src/assets/quino-al-unsplash.jpg',
            content: newCom,
            date: formattedDate,
          });
          setNewCom('');
        }}
      ></i>
    </div>
  );
};

export default NewComment;
