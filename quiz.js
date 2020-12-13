let i = 0;
let score = 0;
$(document).ready(function f() {
    $.ajax({
        url: "https://opentdb.com/api.php?amount=10",
        dataType: "json",
        success: function (obj) {
            $("#choices").html("");
            $("#bt_submit").html("Check Answer");
            const children = obj.results[i];
            $("#question").html(children.question);
            let answers = [];
            console.log(children);//remove later
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

            let clicked = false;

            $(".bt_choice").on("click", function () {
                $(".bt_choice").removeAttr("id", "selected");
                $(this).attr("id", "selected");


                $("#bt_submit").on("click", function () {
                    if (clicked) {
                        $(this).off("click");
                        i++;
                        f();
                    }
                    else {
                        clicked = true;
                        $(".bt_choice").off("click");
                        $(".bt_choice").removeClass("hover");
                        $(".bt_choice").css("cursor", "auto");
                        let answer = $("#selected").html();
                        if (answer == children.correct_answer) {
                            console.log("correct");
                            score++;
                            console.log(score);
                            $("#selected").css("background-color", "#29bb66");
                        }
                        else {
                            console.log("wrong");
                            $("#selected").css("background-color", "#e42a2a")
                        }
                        $(this).html("Next Question");
                    }
                })
            })
        }
    })
})