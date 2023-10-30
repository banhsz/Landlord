import { createSlice } from '@reduxjs/toolkit';

const initialState = {
    apartmentArray : [],
};

const apartmentSlice = createSlice({
    name: 'apartmentSlice',
    initialState,
    reducers: {
        loadData: (state, action) => {
            state.apartmentArray = action.payload;
        },
    },
});

export const { loadData } = apartmentSlice.actions;
export default apartmentSlice.reducer;