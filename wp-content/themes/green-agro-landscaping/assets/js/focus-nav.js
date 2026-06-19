( function( window, document ) {
  function green_agro_landscaping_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const green_agro_landscaping_nav = document.querySelector( '.sidenav' );
      if ( ! green_agro_landscaping_nav || ! green_agro_landscaping_nav.classList.contains( 'open' ) ) {
        return;
      }
      const elements = [...green_agro_landscaping_nav.querySelectorAll( 'input, a, button' )],
        green_agro_landscaping_lastEl = elements[ elements.length - 1 ],
        green_agro_landscaping_firstEl = elements[0],
        green_agro_landscaping_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;
      if ( ! shiftKey && tabKey && green_agro_landscaping_lastEl === green_agro_landscaping_activeEl ) {
        e.preventDefault();
        green_agro_landscaping_firstEl.focus();
      }
      if ( shiftKey && tabKey && green_agro_landscaping_firstEl === green_agro_landscaping_activeEl ) {
        e.preventDefault();
        green_agro_landscaping_lastEl.focus();
      }
    } );
  }
  green_agro_landscaping_keepFocusInMenu();
} )( window, document );