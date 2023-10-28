import { createStore } from 'redux';
import rootReducer from './reducers'; // You need to create your rootReducer

const store = createStore(rootReducer);

export default store;