import React from 'react';

import './UsersBtn.css';

const usersBtn = ( props ) => {

    return (
        <button className="users-btn" onClick={props.clicked}><i className="fas fa-users"></i></button>
    )
};

export default usersBtn;