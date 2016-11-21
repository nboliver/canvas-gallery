import React from 'react';
import ReactDOM from 'react-dom';
import PortfolioIndex from './containers/PortfolioIndex';

require('../../scss/canvas-public.scss');

(($) => {

  $(() => {

    window.$ = $;

    const portfolioIndex = document.getElementById('canvas-portfolio-index');
    
    if (portfolioIndex) {
      ReactDOM.render(<PortfolioIndex />, portfolioIndex);
    }

  });
  
})(jQuery);