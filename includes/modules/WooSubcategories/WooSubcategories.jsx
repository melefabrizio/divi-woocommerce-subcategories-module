// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class WooSubcategories extends Component {

  static slug = 'fabb_woo_subcategories';

  render() {
    const Content = this.props.content;

    return (
      <h1>
        {this.props.show_numbers}
      </h1>
    );
  }
}

export default WooSubcategories;
