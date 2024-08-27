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
    const poQuizData = JSON.parse(sessionStorage.getItem("paQuiz"));
    const coGameTimerObject = document.querySelector(".customTimerRadial");

    // Form Prevent Default Logic
    var loAnswerBox = document.getElementById('answerBox');
    if (loAnswerBox.attachEvent) {
        loAnswerBox.attachEvent("submit", preventSubmit);
    } else {
        loAnswerBox.addEventListener("submit", preventSubmit);
    }

    /**
     * Init Game Rules & Timer
     */
    const coGameMaster = {
        // Game Rules
        liLives: 1,
        lbSoloGame: false,              // Boolean solo game (syncs time / sound locally)
        lbQuestionActive: false,        // Boolean question active
        // Game Timer Settings
        lbTimerActive: false,           // Boolean clock active
        lbSoundActive: false,           // Boolean sound active
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
                    startTimer();
                    liClockCycleStart = 999999999999;
                }
                if (coGameMaster.lbTimerActive) {
                    if (coGameMaster.lbSoundActive) {
                        startSound('t1p-30');
                        coGameMaster.lbSoundActive = false;
                    }
                    gradientClock();
                }
            }, 1000);
    }

    /**
    * Display next question
    */
    $('#nextQuestion').on('click', function () {
        resetTimer();
        newQuestion();
    });

    /**
     * Utilitaires - Design
     */

    /**
     * Design - Change gradiance on clock
     */
    function gradientClock() {
        if (coGameMaster.liTimeRemaining >= 0) {
            coGameTimerObject.style.setProperty("--coGradientValue", coGameMaster.liRadiant + "deg")
            const coGradientValue = coGameTimerObject.style.getPropertyValue("--coGradientValue");
            coGameTimerObject.style.background = ` conic-gradient(#eda711 var(--coGradientValue) ,#eda711 0deg ,white 0deg,white 360deg)`
            coGameMaster.liRadiant = coGameMaster.liRadiant - (coGameMaster.liRadiant / coGameMaster.liTimeRemaining);
            coGameMaster.liTimeRemaining--;
        }
        else {
            coGameMaster.liRadiant = 360;
            coGameMaster.liTimeRemaining = ciGameTimer;
            coGameMaster.lbTimerActive = false;
            coGameMaster.lbQuestionActive = false;
        }
    }

    /**
     * Design - Change background rings color
     * @param {string} asClassValue 
     */
    function backgroundRings(asClassValue) {
        $('#bg-rings-upper').removeClass(['bg-rings-ocean', 'bg-rings-gold', 'bg-rings-emerald', 'bg-rings-blood']);
        $('#bg-rings-upper').addClass('bg-rings-' + asClassValue);
        $('#bg-rings-lower').removeClass(['bg-rings-ocean', 'bg-rings-gold', 'bg-rings-emerald', 'bg-rings-blood']);
        $('#bg-rings-lower').addClass('bg-rings-' + asClassValue);
    }

    /**
     * Utilitaires - Quiz
     */

    /**
     * Quiz - Initialize new question
     */
    function newQuestion() {
        // Question becomes live
        coGameMaster.lbQuestionActive = true;
        // Unlock Input
        $("#player_answer").prop('readonly', false);
        // Retrieve question
        sessionStorage.setItem('piQuestionsPlayed', parseInt(sessionStorage.getItem("piQuestionsPlayed")) + 1);
        $.ajax({
            url: $('#answerBox').data("retrievedata"),
            method: 'POST',
            data: {
                aiId: poQuizData[sessionStorage.getItem("piQuestionsPlayed")],
            },
            success: function (aoData) {
                backgroundRings('gold');
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
     * Quiz - Display the result of an user input to a questions
     * @param {*} poData 
     */
    function displayAnswer(poData) {
        resetTimer();
        if ( poData ) {
            backgroundRings('emerald');
        }
        else {
            backgroundRings('blood');
        }
    }

    /**
     * Quiz - Start Timer and Sound effects
     */
    function startTimer() {
        coGameMaster.lbTimerActive = true;
        coGameMaster.lbSoundActive = true;
    }
    /**
     * Quiz - Reset Timer and Sound effects
     */
    function resetTimer() {
        resetSound('t1p-30');
        coGameMaster.lbQuestionActive = false;
        coGameMaster.lbTimerActive = false;
        coGameMaster.lbSoundActive = false;
        coGameMaster.liRadiant = 360;
        coGameMaster.liTimeRemaining = ciGameTimer;

        coGameTimerObject.style.setProperty("--coGradientValue", 0 + "deg")
        coGameTimerObject.style.background = ` conic-gradient(#eda711 0deg ,#eda711 0deg ,white 0deg,white 360deg)`;

        backgroundRings('ocean');
    }

    /**
     * Quiz - Check for answer
     */
    function preventSubmit(e) {
        // IE8- Prevention
        if (e.preventDefault) e.preventDefault();
        // Game Logic
        checkAnswer();
        resetTimer();
        // IE8+ Prevention
        return false;
    }

    /**
     * Quiz - Check for answer
     */
    function checkAnswer() {
        let loFormData = new FormData(document.forms.answerBox);
        // Game Logic
        if (coGameMaster.lbQuestionActive) {
            // Lock Input
            $("#player_answer").prop('readonly', true);
            // Send Value
            $.ajax({
                url: $('#answerBox').data("checkdata"),
                method: 'POST',
                data: {
                    aiId: poQuizData[sessionStorage.getItem("piQuestionsPlayed")],
                    asAnswer: loFormData.get('player_answer'),
                },
                success: function (aoData) {
                    displayAnswer(aoData);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('AJAX error: ' + textStatus);
                }
            });
            // Empty input value after sending
            $("#player_answer").val('');
        }
        else {

        }
    }

    /**
     * Utilitaires - Soundboard
     */

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