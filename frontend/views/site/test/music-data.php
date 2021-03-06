<custom-style>
  <style is="custom-style">
  h2 {
    margin: 30px 0 14px;
  }

  .artist-date {
    @apply --layout-horizontal;
    padding-bottom: 12px;
  }

  .artist {
    @apply --layout-flex;
  }

  time {
    margin-left: 20px;
    font-size: 13px;
    color: #555;
  }

  summary {
    padding: 16px 0;
    font-size: 14px;
    line-height: 1.5;
  }

  .song {
    @apply --layout;
    @apply --layout-center;
    padding: 16px 0;
  }

  .song > .no {
    width: 40px;
  }

  .song > .name {
    @apply --layout-flex;
    padding-right: 10px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  .song > .duration {
    width: 60px;
  }

  .content {
    margin: 196px 120px 120px;
    padding: 32px 32px 60px;
    background-color: #fff;
    color: #333;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14);
  }

  paper-fab {
    position: absolute;
    top: 232px;
    right: 160px;
    --paper-fab-background: #ef6c00;
    --paper-fab-keyboard-focus-background: #de5c00;
    --iron-icon-width: 36px;
    --iron-icon-height: 36px;
  }

  /* mobile layout */
  @media (max-width: 600px) {

    .content {
      margin: 254px 0 0 0;
      box-shadow: none;
    }

    paper-fab {
      top: 290px;
      right: 16px;
    }
  }
  </style>
</custom-style>


<div class="content">
  <h2>GIRL</h2>
  <div class="artist-date">
  <div class="artist">Pharrell Williams</div><time>March 3, 2014</time></div>
  <summary>
    Girl is the second studio album by American recording artist and record producer Pharrell Williams. The album was released on March 3, 2014, through Williams' label i Am Other and Columbia Records.
  </summary>

  <div class="song">
    <div class="no">1</div>
    <div class="name">Marilyn Monroe</div>
    <div class="duration">5:51</div>
    <paper-menu-button vertical-align="top" horizontal-align="right">
      <paper-icon-button icon="more-vert" slot="dropdown-trigger" alt="menu"></paper-icon-button>
      <paper-listbox slot="dropdown-content">
        <paper-item>alpha</paper-item>
        <paper-item>beta</paper-item>
        <paper-item>gamma</paper-item>
        <paper-item>delta</paper-item>
        <paper-item>epsilon</paper-item>
      </paper-listbox>
    </paper-menu-button>
  </div>

  <div class="song">
    <div class="no">2</div>
    <div class="name">Brand New</div>
    <div class="duration">4:31</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">3</div>
    <div class="name">Hunter</div>
    <div class="duration">4:00</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">4</div>
    <div class="name">Gush</div>
    <div class="duration">3:54</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">5</div>
    <div class="name">Happy (From "Despicable Me 2")</div>
    <div class="duration">3:52</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">6</div>
    <div class="name">Come Get It Bae</div>
    <div class="duration">3:21</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">7</div>
    <div class="name">Gust of Wind</div>
    <div class="duration">4:45</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">8</div>
    <div class="name">Lost Queen</div>
    <div class="duration">7:56</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">9</div>
    <div class="name">Know Who You Are</div>
    <div class="duration">3:56</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">10</div>
    <div class="name">It Girl</div>
    <div class="duration">4:49</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">11</div>
    <div class="name">Marilyn Monroe</div>
    <div class="duration">5:51</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">12</div>
    <div class="name">Brand New</div>
    <div class="duration">4:31</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>
<paper-fab icon="social:whatshot"></paper-fab>
</div>

<div class="content">
  <h2>GIRL</h2>
  <div class="artist-date">
  <div class="artist">Pharrell Williams</div><time>March 3, 2014</time></div>
  <summary>
    Girl is the second studio album by American recording artist and record producer Pharrell Williams. The album was released on March 3, 2014, through Williams' label i Am Other and Columbia Records.
  </summary>

  <div class="song">
    <div class="no">1</div>
    <div class="name">Marilyn Monroe</div>
    <div class="duration">5:51</div>
    <paper-menu-button vertical-align="top" horizontal-align="right">
      <paper-icon-button icon="more-vert" slot="dropdown-trigger" alt="menu"></paper-icon-button>
      <paper-listbox slot="dropdown-content">
        <paper-item>alpha</paper-item>
        <paper-item>beta</paper-item>
        <paper-item>gamma</paper-item>
        <paper-item>delta</paper-item>
        <paper-item>epsilon</paper-item>
      </paper-listbox>
    </paper-menu-button>
  </div>

  <div class="song">
    <div class="no">2</div>
    <div class="name">Brand New</div>
    <div class="duration">4:31</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">3</div>
    <div class="name">Hunter</div>
    <div class="duration">4:00</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">4</div>
    <div class="name">Gush</div>
    <div class="duration">3:54</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">5</div>
    <div class="name">Happy (From "Despicable Me 2")</div>
    <div class="duration">3:52</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">6</div>
    <div class="name">Come Get It Bae</div>
    <div class="duration">3:21</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">7</div>
    <div class="name">Gust of Wind</div>
    <div class="duration">4:45</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">8</div>
    <div class="name">Lost Queen</div>
    <div class="duration">7:56</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">9</div>
    <div class="name">Know Who You Are</div>
    <div class="duration">3:56</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">10</div>
    <div class="name">It Girl</div>
    <div class="duration">4:49</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">11</div>
    <div class="name">Marilyn Monroe</div>
    <div class="duration">5:51</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>

  <div class="song">
    <div class="no">12</div>
    <div class="name">Brand New</div>
    <div class="duration">4:31</div>
    <iron-icon icon="more-vert"></iron-icon>
  </div>
<paper-fab icon="social:whatshot"></paper-fab>
</div>
