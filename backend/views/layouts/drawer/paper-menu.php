<link rel="import" href="vendor/bower/paper-item/paper-item.html">
<link rel="import" href="vendor/bower/paper-menu/paper-menu.html">
<link rel="import" href="vendor/bower/paper-menu/paper-submenu.html">
<link rel="import" href="vendor/bower/paper-styles/paper-styles.html">
<style is="custom-style">
  h4 {
    padding-left: 15px;
  }

  .horizontal-section {
    padding: 0 !important;
  }

  .avatar {
    display: inline-block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    background: #ccc;
  }

  paper-item {
    --paper-item: {
      cursor: pointer;
    };
  }

  .sublist paper-item {
    padding-left: 30px;
  }

  .sublist2 paper-item {
    padding-left: 50px;
  }
</style>

<h4>Sub-menu</h4>
<div class="horizontal-section">
  <paper-menu attr-for-item-title="label" multi>
    <paper-submenu label="paper-menu">
      <paper-item class="menu-trigger">paper-menu</paper-item>
      <paper-menu class="menu-content sublist" multi>
        <paper-submenu label="Properties">
          <paper-item class="menu-trigger">Properties</paper-item>
          <paper-menu class="menu-content sublist2">
            <paper-item>focusedItem</paper-item>
            <paper-item>attrForItemTitle</paper-item>
          </paper-menu>
        </paper-submenu>
        <paper-submenu label="Methods">
          <paper-item class="menu-trigger">Methods</paper-item>
          <paper-menu class="menu-content sublist2">
            <paper-item>select(value)</paper-item>
          </paper-menu>
        </paper-submenu>
    </paper-menu>
  </paper-submenu>

  <paper-submenu label="paper-submenu">
    <paper-item class="menu-trigger">paper-submenu</paper-item>
    <paper-menu class="menu-content sublist">
      <paper-submenu label="Properties">
        <paper-item class="menu-trigger">Properties</paper-item>
        <paper-menu class="menu-content sublist2">
          <paper-item>opened</paper-item>
        </paper-menu>
        </paper-submenu>
        <paper-submenu label="Methods">
          <paper-item class="menu-trigger">Methods</paper-item>
          <paper-menu class="menu-content sublist2">
            <paper-item>open()</paper-item>
            <paper-item>close()</paper-item>
            <paper-item>toggle()</paper-item>
          </paper-menu>
      </paper-submenu>
    </paper-menu>
  </paper-submenu>

  <paper-submenu label="Unavailable" disabled>
    <paper-item class="menu-trigger">Unavailable</paper-item>
    <paper-menu class="menu-content sublist">
      <paper-item>Unavailable 1</paper-item>
      <paper-item>Unavailable 2</paper-item>
    </paper-menu>
  </paper-submenu>
</paper-menu>
</div>
