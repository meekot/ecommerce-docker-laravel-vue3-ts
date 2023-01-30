import './bootstrap';
import '~css/app.scss';

// Import all of Bootstrap's JS
import 'bootstrap'


const stickyHeader = () => {
  const header = document.querySelector('header.header');
  const headerTopBar = header.querySelector('.topbar')
  
  const MARGE = 5;

  if (!header || !headerTopBar) {
    return
  }
  document.addEventListener('scroll', () => {
    if (window.scrollY > headerTopBar.scrollTop + headerTopBar.scrollHeight + MARGE) {
      headerTopBar.classList.add('d-none')
      header.classList.add('sticky-top')
    } else {
      headerTopBar.classList.remove('d-none')
      header.classList.remove('sticky-top')
    }
  })
}

stickyHeader()




console.log("WTF")