import React, { Component } from 'react';

import Aux from '../../../hoc/Aux/Aux';
import Button from '../../UI/Button/Button';

class OrderSummary extends Component{
    //This could be a functional component and doesn't need to be class  just to debug this component was converted to class based

    // to highlight that we are updating this component 
    // unecessaryly this gets updated or rerendered so in modal js folder we have implemented a shouldComponentUpdate will check is it necessary to re-render the madal js as ordersummary is wrapped inside the modal in burgerbuilder js folder
    componentDidUpdate(){
        console.log('[OrderSummary] Updated');
    }

    render(){
        const ingredientSummary = Object.keys(this.props.ingredients)
        .map(igkey => {
            return (
                <li key={igkey}>
                    <span style={{textTransform: 'capitalize'}}>{igkey}</span>: {this.props.ingredients[igkey]}
                </li>
            );
        });
        return(
            <Aux>
                <h3>Your Order</h3>
                <p>A delicious burger with the following ingredients:</p>
                <ul>
                    {ingredientSummary}
                </ul>
                <p><strong>Total Price: {this.props.price.toFixed(2)}</strong></p>
                <p>Conitnue to Checkout?</p>
                <Button btnType = "Danger" clicked={this.props.purchaseCanceled}> 
                    CANCEL
                </Button>
                <Button btnType = "Success" clicked={this.props.purchaseContinued}> 
                    CONTINUE
                </Button>
            </Aux>
        );
    }
}
export default OrderSummary;