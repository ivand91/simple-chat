import React from 'react';

import './Message.css';

const message = ( props ) => {

    let classes = ['message'];

    if(props.userId == props.msgArray[2]) {
        classes.push('my-message');
    } else {
        classes.push('other-message');
    }

    return (
        <p id={'msg'+props.msgArray[0]} className={classes.join(' ')}><span>{props.msgArray[3].toUpperCase()}</span>: {props.msgArray[1]}</p>
    )
};

export default message;