import React, { useState } from 'react';
import Comment from './Comments';
import NewComment from './NewComment';

const CommentList = () => {
  const [comments, setComments] = useState([
    {
      img: 'src/assets/quino-al-unsplash.jpg',
      content: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.',
      date: '17/03/2024',
    },
    {
      img: 'src/assets/annie-spratt-unsplash.jpg',
      content: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.',
      date: '12/12/2023',
    },
  ]);

  const addComment = (comment) => {
    setComments([...comments, comment]);
  };

  return (
    <div>
      {comments.map((comment, index) => (
        <Comment
          key={`comment-${index}`}
          img={comment.img}
          content={comment.content}
          date={comment.date}
        />
      ))}
      {/* Passer la fonction au composant enfant */}
      <NewComment addComment={addComment} />
    </div>
  );
};

export default CommentList;
