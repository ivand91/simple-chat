import React, { Component } from 'react';
import axios from 'axios';
import './UserList.css';

class UserList extends Component {

    constructor(props) {
        
        super(props);
        
		this.state = {
            onlineUsers : null,
            url : props.url,
            visibility : props.visibility
        }
        
        console.log(props.visibility);
    }

    componentDidMount() {

        axios.get(this.state.url + 'api/online-users').then(response => {
                
            let users = response.data.onlineUsers.map(( username, index ) => {
                return <li key={index} >{username} </li>
            });

            this.setState({
                onlineUsers : users
            });

        }).catch((error) => {
            console.log(error);
        });

        window.Echo.channel('online-users').listen('OnlineUsers', (event) => {

            let users = event.onlineUsers.map(( username, index ) => {
                return <li key={index} >{username} </li>
            });

            this.setState({
                onlineUsers : users
            });
        });
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            visibility : nextProps.visibility
        });
    }

    render() {

        let classes = ['user-list', this.state.visibility];

        return (
            <div className={classes.join(' ')}>
                <p>ONLINE USERS</p>
                <ul>
                    {this.state.onlineUsers}
                </ul>
                <a href={this.state.url + "logout"} className="btn-logout">Logout</a>
            </div>
        )
    }
};

export default UserList;