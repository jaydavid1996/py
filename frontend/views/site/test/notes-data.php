<custom-style>
  <style is="custom-style">
  .content {
    @apply --layout-horizontal;
    @apply --layout-wrap;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    padding: 190px 4px 4px;
    box-sizing: border-box;
  }

  .card {
    width: calc(50% - 8px);
    height: 200px;
    margin: 4px;
    background-color: #90A4AE;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14);
  }

  .cyan {
    background-color: #00BCD4;
  }

  .teal {
    background-color: #009688;
  }

  .purple {
    background-color: #9c27b0;
  }

  .blue {
    background-color: #4285f4;
  }

  .orange {
    background-color: #FF5722;
  }
  </style>
</custom-style>

<div class="content">
  <div class="card"></div>
  <div class="card orange"></div>
  <div class="card purple"></div>
  <div class="card cyan"></div>
  <div class="card orange"></div>
  <div class="card"></div>
  <div class="card teal"></div>
  <div class="card blue"></div>
  <div class="card cyan"></div>
  <div class="card purple"></div>
</div>
