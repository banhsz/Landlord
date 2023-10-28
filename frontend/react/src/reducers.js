const initialState = {
    count: 6,
    apartmentData: "no results"
};

const rootReducer = (state = initialState, action) => {
    switch (action.type) {
        case 'INCREMENT':
            return {...state, count: state.count + 1};
        case 'DECREMENT':
            return {...state, count: state.count - 1};
        case 'loadApartments':
            return {...state, apartmentData: action.payload};
        default:
            return state;
    }
};

export default rootReducer;