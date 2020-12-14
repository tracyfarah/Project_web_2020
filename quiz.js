let i = 0;
let score = 0;
let cat_number = localStorage["category"];
let selected_category = localStorage["select_cat"];
let beforesend = false;
$(document).ready(function f() {
    $.ajax({
        url: `https://opentdb.com/api.php?amount=10&category=${cat_number}`,
        dataType: "json",
        beforeSend: function () {
            if (beforesend == false) {
                $("#loader").show();
                $("#frame").hide();
                beforesend = true
            }
        },
        complete: function (data) {
            $("#loader").hide();
            $("#frame").show();
        },
        success: function (obj) {
            $('#quest_number span').html(i + 1);
            $("#category").html(selected_category);
            $("#choices").html("");
            $("#bt_submit").html("Check Answer");
            const children = obj.results[i];
            let answers = [];
            console.log(children);//remove later
            if (children.difficulty == 'easy') {
                $('#diff span').css("color", "limegreen");
            } else if (children.difficulty == 'medium') {
                $('#diff span').css("color", "orange");
            }
            else if (children.difficulty == 'hard') {
                $('#diff span').css("color", "red");
            }
            $('#diff span').html(children.difficulty);
            $("#question").html(children.question);
            answers.push(children.correct_answer);
            children.incorrect_answers.forEach((val) => {
                answers.push(val);
            })
            answers = answers.sort(() => Math.random() - 0.5) //shuffle answers
            console.log(answers);//remove later
            for (let j = 0; j < answers.length; j++) {
                let ans = document.createElement("button");
                ans.innerHTML = answers[j];
                ans.classList.add("btn");
                ans.classList.add("bt_choice");
                ans.classList.add("hover");
                $("#choices").append(ans);
            }
            $("#joker").on("click", function(e){ //joker to skip a question
                e.stopImmediatePropagation();
                if ($("#skips_left").text() > 0) {
                    if (confirm('Are you sure you want to skip this question?')) {
                        $("#skips_left").text($("#skips_left").text() - 1);
                        if (children.difficulty == 'easy') {
                            score = score + 20;
                        } else if (children.difficulty == 'medium') {
                            score = score + 50;
                        }
                        else if (children.difficulty == 'hard') {
                            score = score + 100;
                        }
                        i++;
                        f();
                    }else{
                        return;
                    }
                }
                else {
                    alert("No more skips left.")
                }
            })

            let clicked = false;

            $(".bt_choice").on("click", function () {
                $(".bt_choice").removeAttr("id", "selected");
                $(this).attr("id", "selected");
                $("#bt_submit").on("click", function (e) {
                    e.stopImmediatePropagation();
                    if (clicked) {
                        $(this).off("click");
                        i++;
                        if (i > 9) {
                            $("#frame").html("");
                            $("#frame").append("Total Score: " + score); //display score in a better way (html+css)
                            let bt_playagain = document.createElement("button");
                            bt_playagain.innerHTML = "Play Again";
                            let bt_home = document.createElement("button");
                            bt_home.innerHTML = "Return to Main Page";
                            $("#frame").append('<br><br>');
                            $("#frame").append(bt_playagain);
                            $("#frame").append('<br><br>');
                            $("#frame").append(bt_home);
                            $(bt_playagain).on("click", () => {
                                i = 0;
                                window.location.href = "./category.html"
                            })
                            $(bt_home).on("click", () => {
                                window.location.href = "./index.html"
                            })
                        } else {
                            f();
                        }
                    }
                    else {
                        clicked = true;
                        $(".bt_choice").off("click");
                        $(".bt_choice").removeClass("hover");
                        $(".bt_choice").css("cursor", "auto");
                        let answer = $("#selected").html();
                        if (answer == children.correct_answer) {
                            console.log("correct");
                            if (children.difficulty == 'easy') {
                                score = score + 20;
                            } else if (children.difficulty == 'medium') {
                                score = score + 50;
                            }
                            else if (children.difficulty == 'hard') {
                                score = score + 100;
                            }
                            console.log(score);
                            $("#selected").css("background-color", "limegreen");
                            $("#selected").css("border-color", "green");
                        }
                        else {
                            console.log("wrong");
                            $("#selected").css("background-color", "red");
                            $("#selected").css("border-color", "darkred");
                        }
                        $(this).html("Next Question");
                    }
                })
            })
        }
    })
})