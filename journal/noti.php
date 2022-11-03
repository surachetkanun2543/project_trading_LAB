<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&family=Thasadith&display=swap');

        * {
            font-family: 'IBM Plex Sans Thai', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 13px;
        }

        ::-webkit-scrollbar-track {

            -webkit-box-shadow: inset 1px 1px 2px #E0E0E0;
            border: 11px solid #D8D8D8;
        }

        ::-webkit-scrollbar-thumb {
            background: #646464;
            -webkit-box-shadow: inset 1px 1px 2px rgba(155, 155, 155, 0.4);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #aaaaaa;
        }

        ::-webkit-scrollbar-thumb:active {
            background: #888;
            -webkit-box-shadow: inset 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style: none;
        }

        /*mobile mode*/
        @media only screen and (max-width:480px) {
            ul {
                position: fixed;
                display: block;
                margin-left: 20px;
                margin-top: 35vw;
                z-index: 3;
            }

            .nav {
                position: fixed;
                display: block;
                font-size: 12px;
                transform: rotate(-90deg);
                margin-left: 0px;
                margin-top: 15vw;
                letter-spacing: 0.2vw;
                z-index: 3;
            }

            li {
                content: '';
                height: 40px;
                width: 5px;
                transition: width 0.3s ease-in-out;
            }

            li:hover {
                transition: width 0.3s ease-in-out;
                width: 8.3vw;
            }

            #eyes {
                background-color: #7e8cdd;
            }

            #full {
                background-color: #302c2d;
            }

            #shine {
                background-color: #7c7b76;
            }

            #barry {
                background-color: #38434b;
            }

            #orange {
                background-color: orange;
            }

            #strange {
                background-color: #494746;
            }

            #space {
                background-color: #c7c7c7;
            }

            #lol {
                background-color: #f26667;
            }

            #sparta {
                background-color: #e32001;
            }

            #kill {
                background-color: #5e5e5e;
            }

            section {
                position: relative;
                display: block;
                width: 100%;
                height: 100vh;
                overflow: hidden;
            }

            section .cover {
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            section .cover img #hero {
                position: absolute;
                display: block;
                min-width: 150%;
                min-height: 150%;
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }

            section .content {
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                z-index: 2;
            }

            section .text {
                width: 100%;
            }

            .centralize {
                position: relative;
                left: 50%;
                top: 30%;
                -webkit-transform: translateZ(0px) translateX(-50%) translateY(-50%);
                transform: translateX(-50%) translateY(-50%);
            }

            #hero {
                position: absolute;
                padding-top: 70vw;
                margin-left: 15vw;
                width: 70vw;
                overflow: hidden;
                -webkit-animation: rotation 40s infinite linear;
            }

            @-webkit-keyframes rotation {
                from {
                    -webkit-transform: rotate(0deg);
                }

                to {
                    -webkit-transform: rotate(359deg);
                }
            }

            img {
                width: 100%;
            }

            #title {
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 9vw;
                margin-top: 31vw;
                margin-left: 17vw;
                line-height: 6vw;
                color: #302c2d;
                opacity: 1;
                animation: move 5s
            }

            @keyframes move {
                from {
                    margin-top: 13vw;
                    opacity: 0.2;
                }

                to {
                    margin-top: 31vw;
                    opacity: 1;
                }
            }

            .name {
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 2.9vw;
                letter-spacing: 0.1vw;
                margin-top: 5vw;
                margin-left: 17vw;
            }

            #line {
                position: absolute;
                content: '';
                margin-top: -21vw;
                margin-left: 55vw;
                height: 1px;
                width: 28vw;
                background-color: #302c2d;
                z-index: 5;
                animation: expand 3s;
                animation-fill-mode: forwards;
            }

            @keyframes expand {
                from {
                    width: 0vw;
                    opacity: 0;
                }

                to {
                    width: 28vw;
                    opacity: 1;
                }
            }

            .scroll {
                position: relative;
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 3vw;
                font-weight: 900;
                letter-spacing: 0.3vw;
                color: #302c2d;
                margin-left: 30vw;
                margin-top: 70vw;
            }

            .square {
                position: relative;
                content: '';
                float: right;
                height: 120vh;
                width: 100vh;

            }

            .copy {
                width: 70vw;
                margin-left: 18vw;
                margin-top: 30vw;
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 2.8vw;
                line-height: 3.4vw;
                letter-spacing: 0.3vw;
                color: black;
            }

            #eyes2 {
                background: linear-gradient(to bottom right, #00e3df, #f63adb);
            }

            .poster {
                width: 70vw;
                margin-top: 4vw;
                margin-left: 18vw;
                z-index: 1;
            }

            #metal {
                color: #dddddd;
            }

            #shine1 {
                color: #ffffff;
            }

            #lyndon {
                color: #b7b7ae;
            }

            #love {
                color: #ecdbec;
            }

            #ita {
                color: #ffffff;
            }
        }

        /*desktop mode*/
        @media only screen and (min-width:1000px) {
            ul {
                position: fixed;
                display: block;
                margin-left: 37px;
                margin-top: 7vw;
                z-index: 3;
            }

            .nav {
                position: fixed;
                display: block;
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 0.85vw;
                transform: rotate(-90deg);
                margin-left: 1vw;
                margin-top: 3vw;
                letter-spacing: 0.2vw;
                z-index: 3;
            }

            li {
                content: '';
                height: 40px;
                width: 5px;
                transition: width 0.3s ease-in-out;
            }

            li:hover {
                transition: width 0.3s ease-in-out;
                width: 80px;
            }

            #eyes {
                background-color: #7e8cdd;
            }

            #full {
                background-color: #302c2d;
            }

            #shine {
                background-color: #7c7b76;
            }

            #barry {
                background-color: #38434b;
            }

            #orange {
                background-color: orange;
            }

            #strange {
                background-color: #494746;
            }

            #space {
                background-color: #c7c7c7;
            }

            #lol {
                background-color: #f26667;
            }

            #sparta {
                background-color: #e32001;
            }

            #kill {
                background-color: #5e5e5e;
            }

            section {
                position: relative;
                display: block;
                width: 100%;
                height: 60vw;
                overflow: hidden;
            }

            section .cover {
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            section .cover img #hero {
                position: absolute;
                display: block;
                min-width: 100%;
                min-height: 100%;
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }

            section .content {
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                z-index: 2;
            }

            section .text {
                width: 100%;
            }

            .centralize {
                position: relative;
                left: 50%;
                top: 30%;
                -webkit-transform: translateZ(0px) translateX(-50%) translateY(-50%);
                transform: translateX(-50%) translateY(-50%);
            }

            #hero {
                position: absolute;
                padding-top: -9vw;
                margin-left: 50vw;
                width: 38vw;
                overflow: hidden;
                -webkit-animation: rotation 180s infinite linear;
            }

            @-webkit-keyframes rotation {
                from {
                    -webkit-transform: rotate(0deg);
                }

                to {
                    -webkit-transform: rotate(359deg);
                }
            }

            img {
                width: 100%;
            }

            #title {
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 4.31vw;
                margin-top: 9vw;
                margin-left: 10vw;
                line-height: 2.63vw;
                color: #302c2d;
                opacity: 1;
                animation: move 3s
            }

            @keyframes move {
                from {
                    margin-left: 8vw;
                    opacity: 0.3;
                }

                to {
                    margin-left: 10vw;
                    opacity: 1;
                }
            }

            .name {
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 1vw;
                letter-spacing: 0.25vw;
                margin-top: 2.63vw;
                margin-left: 10.1vw;
            }

            #line {
                position: absolute;
                content: '';
                margin-top: -10vw;
                margin-left: 28vw;
                height: 1px;
                width: 13.68vw;
                background-color: #302c2d;
                z-index: 5;
                animation: expand 3s;
                animation-fill-mode: forwards;
            }

            @keyframes expand {
                from {
                    width: 0vw;
                    opacity: 0;
                }

                to {
                    width: 13.68vw;
                    opacity: 1;
                }
            }

            .scroll {
                position: relative;
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 0.80vw;
                font-weight: 900;
                letter-spacing: 0.1vw;
                color: #302c2d;
                margin-left: 45vw;
                margin-top: 20vw;
            }

            .square {
                position: relative;
                content: '';
                float: right;
                height: 120vh;
                width: 100vh;

            }

            .copy {
                float: left;
                width: 29.28vw;
                margin-left: 13vw;
                margin-top: 4vw;
                font-family: 'IBM Plex Sans Thai', sans-serif;
                font-size: 1.31vw;
                line-height: 2vw;
                letter-spacing: 0.2vw;
                color: black;
            }

            #eyes2 {
                background: linear-gradient(to bottom right, #00e3df, #f63adb);
            }

            .poster {
                overflow: hidden;
                width: 29.28vw;
                margin-top: 6vw;
                margin-left: 61vw;
                z-index: 1;
            }
        }
    </style>
</head>

<body>
    <div class='nav'>
        <h2> บันทึกรายการสำเร็จ ! </h2>
        <br>
    </div>
    <h4> บันทึกรายการเรียบร้อย! (journaltrading.tech) <br>
        ยินดีด้วย คุณบันทึกรายการซื้อขายสำเร็จ <br>
    </h4>
    <ul>
        <a href='#sctr1'>
            <li id='eyes'></li>
        </a>
        <a href='#sctr2'>
            <li id='full'></li>
        </a>
        <a href='#sctr3'>
            <li id='shine'></li>
        </a>
        <a href='#sctr4'>
            <li id='barry'></li>
        </a>
        <a href='#sctr5'>
            <li id='orange'></li>
        </a>
        <a href='#sctr6'>
            <li id='space'></li>
        </a>
        <a href='#sctr7'>
            <li id='strange'></li>
        </a>
        <a href='#sctr8'>
            <li id='lol'></li>
        </a>
        <a href='#sctr9'>
            <li id='sparta'></li>
        </a>
        <a href='#sctr10'>
            <li id='kill'></li>
        </a>
    </ul>
    <section class="special" data-scrollax-parent="true" id='ntr'>
        <div class="cover" id='hero' data-scrollax="properties: { translateY: '30%', 'opacity': 1.5 }">
            <br>
            <img src='img/noti.png'>
        </div>
        <div class="content">
            <div class="text centralize">
                <div data-scrollax="properties: { 'translateY': '150%', 'opacity': 1.5 }">
                    <div class="scroll">Yours sincerely, <br> journaltrading.tech จดบันทึกและวิเคราะห์การลงทุน </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>