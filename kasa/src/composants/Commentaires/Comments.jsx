import React from 'react';

const Comment = ({ img, content, date }) => {
  return (
    <div className="comment">
      <img src={img} alt="Profile" />
      <div>
        <p>{content}</p>
        <span>{date}</span>
      </div>
    </div>
  );
};

export default Comment;
