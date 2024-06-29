/**
 * The 1 Percent Club - Game Logic Messenger
 */

jQuery(function () {
    /** 
     * Const and Variables for Game
     */
    const ciGameTimer = 30;
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
    var loTimerDiv = document.querySelector(".customTimerRadial");
    var lbStartTimer = false;
    var lbStartTimerSound = false;
    var liTimerRadiant = 360;
    let liTimerSeconds = ciGameTimer;

    let liInfiniteCounter = 0;
    let liClockCycleStart = 999999999999;

    var loTimerInterval = setInterval(() => {
        liInfiniteCounter++;
        if (liClockCycleStart < liInfiniteCounter) {
            startTimer();
            liClockCycleStart = 999999999999;
        }
        if ( lbStartTimer ) {
            if ( lbStartTimerSound ) {
                startSound('t1p-30');
                lbStartTimerSound = false;
            }
            if ( liTimerSeconds >= 0 ) {
                loTimerDiv.style.setProperty("--coGradientValue", liTimerRadiant + "deg")
                const coGradientValue = loTimerDiv.style.getPropertyValue("--coGradientValue");
                loTimerDiv.style.background = ` conic-gradient(#eda711 var(--coGradientValue) ,#eda711 0deg ,white 0deg,white 360deg)`
                liTimerRadiant = liTimerRadiant - (liTimerRadiant / liTimerSeconds);
                liTimerSeconds--;
            }
            else {
                liTimerRadiant = 360;
                liTimerSeconds = ciGameTimer;
                lbStartTimer = false;
            }
        }
    }, 1000)

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
        resetTimer();
        newQuestion();
    });

    /**
     * Utilitaires
     */

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
     */
    function displayQuestion(poData) {
        updateTitle(poData.question_title);
        updatePercent(poData.question_level);
        updateComplement(poData.question_visuals);
        liClockCycleStart = liInfiniteCounter + 5;
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
     */
    function startTimer() {
        lbStartTimer = true;
        lbStartTimerSound = true;
    }
    /**
     * Quiz - Reset Timer and Sound effects
     */
    function resetTimer() {
        resetSound('t1p-30');
        lbStartTimer = false;
        lbStartTimerSound = false;
        liTimerRadiant = 360;
        liTimerSeconds = ciGameTimer;
        loTimerDiv.style.setProperty("--coGradientValue", 0 + "deg")
        loTimerDiv.style.background = ` conic-gradient(#eda711 0deg ,#eda711 0deg ,white 0deg,white 360deg)`;
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