<?php
define('GAME_URL', 'http://localhost:5500/');
require("include/head.php") ?>

<body>

    <?php require("include/nav.php"); ?>


    <div class="selector">
        <button class="arrow left"><img src="rs/arrown.png" alt=""></button>
        <ul class="level-list">
            <li>
                <a href="http://localhost:5500/" data-map='{"height":10,"width":7,"diff":2,"data":[0,0,0,-3,-3,0,0,0,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,0,-1,0,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,0,-3,-3,-3,-3,0,0,0],"start":{"x":1,"y":9},"end":{"x":4,"y":0}}' class="card">
                    <img src="" class="card__image" alt="" />
                    <div class="card__header">
                        <h3 class="card__title">Jessica Parker</h3>
                        <span class="card__status">EASY</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="http://localhost:5500/" data-map='{"data":[-2,2,2,-3,-3,-3,-3,-3,-3,-3,-3,-3,-3,-3,-1,-1,0,-1,-3,-3,-3,-3,-3,-3,0,0,-1,-3,-3,-3,-3,0,0,0,-3,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,-1,-3,-1,-1,-1,-1,-1,-1,-1,-1,-3,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,-1,-3,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,-1,-1,-1,-1,-3,-1,0,-3,-1,-1,-1,-1,-1,-3,0,-3,-2,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,-1,-1,-1,-1,-1,-2,-3,-1,-1,-1,-1,-1,-1,-1,0,-3,-3,-1,-2,-1,-1,-1,-1,-1,-1,-1,-1,-3,-1,-1,-1,-1,-1,-3,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,-3,-3,-1,-3,-1,-1,-1,-1,-1,-3,-1,-1,-1,-1,-1,-1,-1,-1,-2,-1,-1,-1,-3,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-2,-3,-3,-3,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,0,0,0,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,-2,0,0,-1,-3,-1,-1,-2,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,0,0,0,0,0,0,-3,-3,-1,-2,-3,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,-3,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1],"width":20,"height":20,"start":{"x":1,"y":2},"end":{"x":9,"y":1}}' class="card">
                    <img src="" class="card__image" alt="" />
                    <div class="card__header">
                        <h3 class="card__title">Jessica Parker</h3>
                        <span class="card__status">EASY</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="http://localhost:5500/" data-map='{"height":10,"width":7,"diff":2,"data":[0,0,0,-3,-3,0,0,0,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,0,-1,0,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,0,-3,-3,-3,-3,0,0,0],"start":{"x":1,"y":9},"end":{"x":4,"y":0}}' class="card">
                    <img src="" class="card__image" alt="" />
                    <div class="card__header">
                        <h3 class="card__title">Jessica Parker</h3>
                        <span class="card__status">EASY</span>
                    </div>
                </a>
            </li>
            <li style="display: none;">
                <a href="http://localhost:5500/" data-map='{"height":10,"width":7,"diff":2,"data":[0,0,0,-3,-3,0,0,0,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,0,-1,0,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,0,-3,-3,-3,-3,0,0,0],"start":{"x":1,"y":9},"end":{"x":4,"y":0}}' class="card">
                    <img src="" class="card__image" alt="" />
                    <div class="card__header">
                        <h3 class="card__title">Jessica Parker</h3>
                        <span class="card__status">EASY</span>
                    </div>
                </a>
            </li>
        </ul>
        <button class="arrow right"><img src="rs/arrown.png" alt=""></button>
    </div>

    <!-- <div class="deck">
        <ul class="cards">
            <li>
                <a href="" class="card">
                    <img src="https://i.imgur.com/oYiTqum.jpg" class="card__image" alt="" />
                    <div class="card__overlay">
                        <div class="card__header">
                            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                                <path />
                            </svg>
                            <img class="card__thumb" src="https://i.imgur.com/7D7I6dI.png" alt="" />
                            <div class="card__header-text">
                                <h3 class="card__title">Jessica Parker</h3>
                                <span class="card__status">1 hour ago</span>
                            </div>
                        </div>
                        <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="" class="card">
                    <img src="https://i.imgur.com/2DhmtJ4.jpg" class="card__image" alt="" />
                    <div class="card__overlay">
                        <div class="card__header">
                            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                                <path />
                            </svg>
                            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
                            <div class="card__header-text">
                                <h3 class="card__title">kim Cattrall</h3>
                                <span class="card__status">3 hours ago</span>
                            </div>
                        </div>
                        <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="" class="card">
                    <img src="https://i.imgur.com/oYiTqum.jpg" class="card__image" alt="" />
                    <div class="card__overlay">
                        <div class="card__header">
                            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                                <path />
                            </svg>
                            <img class="card__thumb" src="https://i.imgur.com/7D7I6dI.png" alt="" />
                            <div class="card__header-text">
                                <h3 class="card__title">Jessica Parker</h3>
                                <span class="card__tagline">Lorem ipsum dolor sit amet consectetur</span>
                                <span class="card__status">1 hour ago</span>
                            </div>
                        </div>
                        <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="" class="card">
                    <img src="https://i.imgur.com/2DhmtJ4.jpg" class="card__image" alt="" />
                    <div class="card__overlay">
                        <div class="card__header">
                            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                                <path />
                            </svg>
                            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
                            <div class="card__header-text">
                                <h3 class="card__title">kim Cattrall</h3>
                                <span class="card__status">3 hours ago</span>
                            </div>
                        </div>
                        <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="selector">

        <h1 id="p2-title">Preview</h1>
        <div id="p2-text" class="case1--">
            <ul class="levels">
                <li>
                    <button class="level" data-map='{"header":{"height":10,"width":7,"diff":2},"body":{"data":[0,0,0,-3,-3,0,0,0,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,0,-1,0,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,0,-3,-3,-3,-3,0,0,0],"start":{"x":1,"y":9},"end":{"x":4,"y":0}}}'>PokeLevel</button>
                </li>
                <li>
                    <button class="level" data-map='{"header":{"height":10,"width":7,"diff":2},"body":{"data":[0,0,0,-3,-3,0,0,0,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,-1,0,-1,0,-1,0,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,0,-3,-3,-3,-3,0,0,0],"start":{"x":1,"y":9},"end":{"x":4,"y":0}}}'>AutreLevel</button>
                </li>
                <li>
                    <button class="level" data-map='{"header":{"width":25,"height":20,"diff":9},"body":{"start":{"x":1,"y":0},"end":{"x":10,"y":18},"data":[-1,-3,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,0,-1,0,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-3,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,0,0,-1,0,-1,-1,-1,-1,-1,-1,-1,0,-1,-1,-1,-1,-1,-1,-1,-1]}}'>RandomLevel</button>
                </li>


            </ul>

        </div>

        <div class="game-window">
            <iframe id="game" src="https://bafbi.github.io/glagla/" frameborder="0"></iframe>

        </div>
    </div> -->

    <?php require("include/foot.php") ?>
    <script src="static/preview.js"> </script>

</body>

</html>