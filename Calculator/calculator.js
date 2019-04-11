/**
 * Hier ziet u een stuk code van mijn calculator die ik gemaakt heb in React JS.
 * De render functie zit er niet bij, maar daar stonden alleen buttons is met een onclick functie.
 */

import React, {Component} from "react"
import CalculatorButton from "./CalculatorButton";

export default class Calculator extends Component {
    /**
     * Zet de basis state
     */
    state = {
        currentNumber: "",
        total: 0,
        operator: "",
    }
    /**
     * Update de State
     * @param number
     */

    updateNumber = number => {
        this.setState({currentNumber: this.state.currentNumber + number});
    }

    /**
     * Hier update hij de string, zodat de currentnumber naar total gaat en reset de currentnumber naar 0. Ook slaat hij de operator op in een string.
     * @param string
     */
    stringUpdate = string => {
        this.setState({total: this.state.currentNumber})
        this.setState({currentNumber: ""})
        this.setState({operator: string})
    }

    /**
     * Hier rekent hij de ingevulde waardes uit als je op '=' drukt.
     */

    equalsNumber = () => {
        this.setState({currentNumber: eval(this.state.total + this.state.operator + this.state.currentNumber)})
    }

    /**
     * Hier reset hij alle states. Zodat de gebruiker weer opnieuw kan beginnen.
     */
    resetNumber = () => {
        this.setState({currentNumber: 0})
        this.setState({total: 0})
        this.setState({operator: ""})
    }

    /**
     * Geef een nummer terug, als current number 0 is dan het totaal
     *
     * @return {number}
     */
    showCalculationNumber = () => {
        if (this.state.currentNumber) {
            return this.state.currentNumber;
        }
        return this.state.total;
    }
}

