import axios from 'axios';

//creates a instance of axios class
const instance = axios.create({
    baseURL: 'https://react-my-burger-1ed6b.firebaseio.com/'
});

export default instance;