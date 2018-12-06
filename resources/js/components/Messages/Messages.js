import React from 'react';

import Message from './Message/Message';

const messages = (props) => props.messages.map(( message, index ) => {
    return <Message key={index} msgArray={message} userId={props.aui}/>
});

export default messages;