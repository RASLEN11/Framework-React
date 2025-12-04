import React, { useState } from 'react';
import './Commentaire.css';

const Commentaire = () => {
  const [comments, setComments] = useState([]);
  const [newComment, setNewComment] = useState("");

  const handleAddComment = () => {
    if (newComment.trim() === "") return;

    const newCommentObject = {
      id: comments.length + 1,
      author: "Utilisateur",
      date: new Date().toLocaleString(),
      content: newComment,
    };

    setComments([newCommentObject, ...comments]);
    setNewComment("");
  };

  return (
    <div style={{ padding: "20px", fontFamily: "Arial, sans-serif" }}>
      <h1>Gestion des Commentaires</h1>
      <h2>Total : {comments.length} commentaire(s)</h2>
      <div>
        {comments.map((comment) => (
          <div className="commentaire" key={comment.id}>
            <div className="commentaire-header">
              <strong>{comment.author}</strong> - <span className="commentaire-date">{comment.date}</span>
            </div>
            <p className="commentaire-content">{comment.content}</p>
          </div>
        ))}
      </div>
      <textarea
        placeholder="Écrivez un commentaire..."
        value={newComment}
        onChange={(e) => setNewComment(e.target.value)}
        style={{ width: "100%", height: "80px", marginBottom: "10px" }}
      />
      <button onClick={handleAddComment} style={{ padding: "10px 20px", marginBottom: "20px" }}>
        Ajouter un commentaire
      </button>
      
    </div>
  );
};

export default Commentaire;
