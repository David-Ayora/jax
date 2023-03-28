<style>
    .menu {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

li {
  display: inline-block;
  margin-right: 20px;
}

a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
}

.tab-container {
  border: 1px solid #ccc;
  padding: 20px;
}

.tab {
  display: none;
}

.tab.active {
  display: block;
}

</style>
<div class="menu">
  <ul>
    <li><a href="#" data-tab="item1">Item 1</a></li>
    <li><a href="#" data-tab="item2">Item 2</a></li>
    <li><a href="#" data-tab="item3">Item 3</a></li>
  </ul>
  <div class="tab-container">
    <div id="item1" class="tab">
      <h2>Item 1</h2>
      <input type="text" placeholder="Texto del Item 1">
    </div>
    <div id="item2" class="tab">
      <h2>Item 2</h2>
      <input type="text" placeholder="Texto del Item 2">
    </div>
    <div id="item3" class="tab">
      <h2>Item 3</h2>
      <input type="text" placeholder="Texto del Item 3">
    </div>
  </div>
</div>

<script>
    const tabs = document.querySelectorAll('.tab');
const links = document.querySelectorAll('a');

for (const link of links) {
  link.addEventListener('click', (event) => {
    event.preventDefault();
    const tabId = event.target.getAttribute('data-tab');
    for (const tab of tabs) {
      tab.classList.remove('active');
      if (tab.getAttribute('id') === tabId) {
        tab.classList.add('active');
      }
    }
  });
}

</script>