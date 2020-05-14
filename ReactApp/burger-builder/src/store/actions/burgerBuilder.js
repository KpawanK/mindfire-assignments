import * as actionTypes from './actionTypes';
import axios from '../../axios-orders';

export const addIngredient = (name) => {
    return{
        type: actionTypes.ADD_INGREDIENT,
        ingredientName: name
    };
};

export const removeIngredient = (name) => {
    return{
        type: actionTypes.REMOVE_INGREDIENT,
        ingredientName: name
    };
};

export const setIngredients = (ingredients) => {
    return{
        type: actionTypes.SET_INGREDIENTS,
        ingredients: ingredients
    };
};

export const fetchIngredientsFailed = () => {
    return{
        type:actionTypes.FETCH_INGREDIENTS_FAILED
    }
}

//asynchronus code to fetch ingredients using redux
//the above setIngredients sync function will run/dispatch once the async code in initIngredients is done
export const initIngredients = () => {
    return dispatch => {
        axios.get('https://react-my-burger-1ed6b.firebaseio.com/ingredients.json')
            .then(response => {
                dispatch(setIngredients(response.data));
            })
            .catch(error => {
               dispatch(fetchIngredientsFailed());
            });
    };
};