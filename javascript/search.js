const searchProducts = document.querySelector("#searchproduct")

if (searchProducts) {
    searchProducts.addEventListener('input', async function() {

        const typeSearch = document.querySelector("#critério")
        const querie = '../api/product.api.php?search=' + this.value + '&type=' + typeSearch.value
        const response = await fetch(querie)
        const products = await response.json()
        const section = document.querySelector('#searchproducts')
        section.innerHTML = ''
        if (this.value.length == "") return;

        if (!Object.keys(products).length) {
            const error = document.createElement('h3')
            error.textContent = ""
            error.className = "error"
            section.appendChild(error)
        }

        for (const product of products) {
            const article = document.createElement('article')
            const link = document.createElement('a')
            link.href = 'productPage.php?id=' + product.id
            link.textContent = product.name
            article.appendChild(link)
            section.appendChild(article)
      }
  })
}


  /* Mobile dropdown */

document.addEventListener('DOMContentLoaded', function() {
  var searchDropdown = document.getElementById('searching');
  var searchLogo = document.getElementById('Search_Logo');

  // Add the click event listener
  searchLogo.addEventListener('click', function() {
    if (window.innerWidth <= 768) {
      if (searchDropdown.style.display === 'none' || searchDropdown.style.display === '') {
        searchDropdown.style.display = 'flex';
      } else {
        searchDropdown.style.display = 'none';
      }
    }
  });

  window.addEventListener('resize', function() {
    // If the screen width surpasses 768 pixels, remove the inline style
    if (window.innerWidth > 768) {
      searchDropdown.style.display = 'flex';
    }
    else {
      searchDropdown.style.display = 'none';
    }
  });

});