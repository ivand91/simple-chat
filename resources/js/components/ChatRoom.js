import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MediaQuery from 'react-responsive';

import UserList from './UserList/UserList';
import TextBox from './TextBox/TextBox';
import Messages from './Messages/Messages';
import UsersBtn from './UsersBtn/UsersBtn';

export default class ChatRoom extends Component {

    constructor() {
        super();
        
        let appUrl = null;

        if(window.location.host == 'localhost') {
            appUrl = window.location.protocol+"//"+window.location.host+"/chat/public/";
        } else {
            appUrl = window.location.protocol+"//"+window.location.host+"/";
        }
        
        this.state = {
            url : appUrl,
            message: '',
            messages : [],
            authUserId : null,
            showOnlineUsers : false,
            visibility : 'hide'
        }
        
        this.handleMessage = this.handleMessage.bind(this);
        this.postMessage = this.postMessage.bind(this);
        this.showOnlineUsers = this.showOnlineUsers.bind(this);
    }

    componentDidMount() {
        this.setState({
            authUserId : document.getElementById('userId').value
        });

        axios.get(this.state.url + 'api/messages').then(response => {

            this.setState({
                messages : response.data.messages
            });

            let msgswindow = document.getElementById('msgs-window');
            msgswindow.scrollTop = msgswindow.scrollHeight;

        }).catch((error) => {
            console.log(error);
        });

        window.Echo.channel('simple-chat').listen('MessageSent', (event) => {
            this.setState({
                messages : [...this.state.messages, event.message]
            });

            let el = document.getElementById('msg'+event.message[0]);
            el.scrollIntoView({ behavior: 'smooth' });
        });
    }

    handleMessage(event) {
        this.setState({message: event.target.value});
    }

    postMessage() {
        axios.post(this.state.url + 'api/send-message', {message: this.state.message, userId: this.state.authUserId}).then(() => {
            this.setState({
                message : ''
            });
        }).catch(function (error) {
            console.log(error);
        });
    }

    showOnlineUsers() {

        if(this.state.showOnlineUsers) {
            this.setState({
                showOnlineUsers : false,
                visibility : 'hide'
            });
        } else {
            this.setState({
                showOnlineUsers : true,
                visibility : 'show'
            });
        }
    }
    
    render() {

        return (
            <div className="simple-chat">
                <MediaQuery query="(min-device-width: 600px)">
                    <UserList url={this.state.url}/>
                </MediaQuery>
                <MediaQuery query="(max-device-width: 599px)">
                    <UsersBtn clicked={this.showOnlineUsers}/>
                </MediaQuery>
                <div id='msgs-window' className="messages-window">
                    <MediaQuery query="(max-device-width: 599px)">
                        <UserList url={this.state.url} visibility={this.state.visibility}/>
                    </MediaQuery>
                    <Messages messages={this.state.messages} aui={this.state.authUserId}/>
                </div>
                <TextBox changed={this.handleMessage} posted={this.postMessage} val={this.state.message}/>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<ChatRoom />, document.getElementById('app'));
}