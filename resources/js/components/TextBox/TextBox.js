import React from 'react';
import './TextBox.css';

const textBox = ( props ) => {

    return (
        <div className="textbox">
            <textarea placeholder="Message..." onChange={props.changed} value={props.val} ></textarea>
            <button onClick={props.posted} >SEND</button>
        </div>
    )
};

export default textBox;