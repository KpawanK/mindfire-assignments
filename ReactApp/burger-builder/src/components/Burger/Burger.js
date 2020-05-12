import React from 'react';
// import { withRouter } from 'react-router-dom';// this is because the component which is loaded directly by Route component will have the special properties like location  match and moany more if we want the child componenets to access then we need to create a HOC in order to include names withRouter and raped when exported

import classes from './Burger.css';
import BurgerIngredients from './BurgerIngredients/BurgerIngredients';

const burger = ( props ) => {
    console.log('[Burger.js]',props);
    let transformedIngredients = Object.keys(props.ingredients)
        .map(igKey => {
            return [...Array(props.ingredients[igKey])].map((_,i) =>{
                return <BurgerIngredients key = {igKey + i} type =  {igKey}/>
            });
        })
        .reduce((arr , el) => {
            return arr.concat(el)
        }, []);
    
    if(transformedIngredients.length === 0){
        transformedIngredients = <p>Please start adding ingredients!</p>
    }
    
    return (
        <div className={classes.Burger}>
            <BurgerIngredients type="bread-top" />
            {transformedIngredients}
            <BurgerIngredients type="bread-bottom" />
        </div>
    ); 
}

export default burger;