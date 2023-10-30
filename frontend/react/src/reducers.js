import { combineReducers } from 'redux';
import apartmentSlice from './apartmentSlice';

const rootReducer = combineReducers({
    apartmentSlice: apartmentSlice,
});

export default rootReducer;