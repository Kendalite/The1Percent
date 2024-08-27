/**
 * The 1 Percent Club - Game Logic Messenger
 */

jQuery(function () {
    /** 
     * Const and Variables for Game
     */
    const ciGameTimer = 30; // Numbers of seconds in the timer
    const csGamemode = ''; //  Type of gamemode played by the user at load
    const ciDelayStart = 5; // Number of seconds before the timer starts
    // Set up CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let retrieveDataLink = $('#startShow').data("target");
    let poQuizData = JSON.parse(sessionStorage.getItem("paQuiz"));

    /** 
     * Init Interval Timer
     */
    const gameTimer = {
        loObject: document.querySelector(".customTimerRadial"), // Object HTML
        lbTimerActive: false,           // Boolean clock active
        lbSoundActive: false,           // Boolean sound active
        lbSoloGame: false,              // Boolean solo game (syncs time / sound locally)
        liTimeRemaining: ciGameTimer,   // Integer seconds in timer
        liRadiant: 360                  // Integer Radiant Object HTML
    };
    // Keeping track of cycles on clock
    let liInfiniteCounter = 0;
    let liClockCycleStart = 999999999999;

    /**
     * Game Internal Clock
     */
    switch (csGamemode) {
        case 'Live':
            // Live Clock
            break;
        default:
            // Solo Clock
            var loTimerInterval = setInterval(() => {
                liInfiniteCounter++;
                if (liClockCycleStart < liInfiniteCounter) {
                    startTimer(gameTimer);
                    liClockCycleStart = 999999999999;
                }
                if (gameTimer.lbTimerActive) {
                    if (gameTimer.lbSoundActive) {
                        startSound('t1p-30');
                        gameTimer.lbSoundActive = false;
                    }
                    gradientClock(gameTimer);
                }
            }, 1000);
    }

    /**
    * Start show and display first question
    */
    $('#startShow').on('click', function () {
        newQuestion();
        $('#startShow').remove();
    });

    /**
    * Display next question
    */
    $('#nextQuestion').on('click', function () {
        resetTimer(gameTimer);
        newQuestion();
    });

    /**
     * Utilitaires
     */

    /**
     * Design - Change gradiance on clock
     * @param {*} gameTimer 
     */
    function gradientClock(gameTimer) {
        if (gameTimer.liTimeRemaining >= 0) {
            gameTimer.loObject.style.setProperty("--coGradientValue", gameTimer.liRadiant + "deg")
            const coGradientValue = gameTimer.loObject.style.getPropertyValue("--coGradientValue");
            gameTimer.loObject.style.background = ` conic-gradient(#eda711 var(--coGradientValue) ,#eda711 0deg ,white 0deg,white 360deg)`
            gameTimer.liRadiant = gameTimer.liRadiant - (gameTimer.liRadiant / gameTimer.liTimeRemaining);
            gameTimer.liTimeRemaining--;
        }
        else {
            gameTimer.liRadiant = 360;
            gameTimer.liTimeRemaining = ciGameTimer;
            gameTimer.lbTimerActive = false;
        }
    }

    /**
     * Quiz - Initialize new question
     */
    function newQuestion() {
        sessionStorage.setItem('piQuestionsPlayed', parseInt(sessionStorage.getItem("piQuestionsPlayed")) + 1);
        $.ajax({
            url: retrieveDataLink,
            method: 'POST',
            data: {
                aiId: poQuizData[sessionStorage.getItem("piQuestionsPlayed")],
            },
            success: function (aoData) {
                displayQuestion(aoData);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX error: ' + textStatus);
            }
        });
    }

    /**
     * Quiz - Display the new question
     * @param {*} poData 
     */
    function displayQuestion(poData) {
        // Display information
        updateTitle(poData.question_title);
        updatePercent(poData.question_level);
        updateComplement(poData.question_visuals);
        // Add delay before start of timer to give time to load image properly
        liClockCycleStart = liInfiniteCounter + ciDelayStart;
    }

    /**
     * Quiz - Update question title
     * @param {*} asTitle 
     */
    function updateTitle(asTitle) {
        $("#t1pQuestionBox").text(asTitle);
    }
    /**
     * Quiz - Update percent level and reset clock
     * @param {*} asPercent 
     */
    function updatePercent(asPercent) {
        $("#t1pPercentBox").text(asPercent);
    }
    /**
     * Quiz - Update complement illustrations and Dispatch screen sizes
     * @param {*} asTitle 
     */
    function updateComplement(aaComplements) {
        // TODO
    }
    /**
     * Quiz - Start Timer and Sound effects
     * @param {*} gameTimer 
     */
    function startTimer(gameTimer) {
        gameTimer.lbTimerActive = true;
        gameTimer.lbSoundActive = true;
    }
    /**
     * Quiz - Reset Timer and Sound effects
     * @param {*} gameTimer 
     */
    function resetTimer(gameTimer) {
        resetSound('t1p-30');
        gameTimer.lbTimerActive = false;
        gameTimer.lbSoundActive = false;
        gameTimer.liRadiant = 360;
        gameTimer.liTimeRemaining = ciGameTimer;
        gameTimer.loObject.style.setProperty("--coGradientValue", 0 + "deg")
        gameTimer.loObject.style.background = ` conic-gradient(#eda711 0deg ,#eda711 0deg ,white 0deg,white 360deg)`;
    }
    /**
     * Soundboard - Start playing
     */
    function startSound(asId) {
        $('#' + asId).get(0).play();
    }
    /**
     * Soundboard - Pause playing
     */
    function pauseSound(asId) {
        $('#' + asId).get(0).pause();
    }
    /**
     * Soundboard - Mute Element
     */
    function muteSound(asId) {
        $('#' + asId).data('muted', true);
    }
    /**
     * Soundboard - Mute All Elements
     */
    function mutePage() {
        $("audio").each(function (index) {
            $(this).data('muted', true);
        });
    }
    /**
     * Soundboard - Stop playing
     */
    function resetSound(asId) {
        $('#' + asId).get(0).pause();
        $('#' + asId).currentTime = 0;
    }
})