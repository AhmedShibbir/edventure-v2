// new vendor's js part for timer starts

        var downloadTimer = setInterval(function () {
            timeleft--;
            var hours = 0;
            var minH = 0;
            var min = 0;
            var sec = timeleft > 0 ? timeleft : 0;
            if (timeleft >=3600) {
                hours = Math.floor(timeleft/3600);
                minH = parseInt(timeleft % 3600) ;
                min = Math.floor(minH / 60);
                sec = parseInt(minH % 60);
            } else if (timeleft >= 60) {
                min = Math.floor(timeleft / 60);
                sec = parseInt(timeleft % 60);
            }
            if (timeleft > 0) {
                document.getElementById('countdownMinuits').textContent = min;
                document.getElementById('countdownSecound').textContent = sec;
                document.getElementById('countdownHour').textContent = hours;
            }
            $('#exam_end_time').val(timeleft)

            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                $('#cqFormSubmit').submit()
            }
        }, 1000);

// new vendor's js part for timer ends




// {{-- ------------------------Frontend Script part for Timer collapse and expand #start--------------------------------------- --}}

        let closeCollapseIcon = document.getElementById("close_collapse_icon");
        let openCollapseIcon = document.getElementById("open_collapse_icon");
        let questionMap = document.getElementById("questionMap");

        /* timer's part starts  */

        const closeCollapse = () => {
            questionMap.classList.add("d-none");
            closeCollapseIcon.classList.remove("d-block");
            closeCollapseIcon.classList.add("d-none");
            openCollapseIcon.classList.add("d-block");

        };
        const openCollapse = () => {
            questionMap.classList.remove("d-none");
            closeCollapseIcon.classList.remove("d-none");
            openCollapseIcon.classList.remove("d-block");
            openCollapseIcon.classList.add("d-none");

        };
        closeCollapseIcon.addEventListener("click", closeCollapse);
        openCollapseIcon.addEventListener("click", openCollapse);

        /* timer's part ends  */

        /* Question Mapping part starts */
        

        let questionCount = 0;
        if (mcqQuestions.length > 0) {
            mcqQuestions.forEach(mcqQuestion => {
                questionCount++;
                let a = document.createElement("a");
                a.className = ("border rounded bg-secondary");
                let span = document.createElement("span");
                span.innerText = questionCount;
                a.setAttribute("id", `map_${mcqQuestion.id}`);
                a.setAttribute("href", `#q_${mcqQuestion.id}`)
                a.appendChild(span);
                questionMap.append(a);
                let optionFiledID = document.getElementById("options_" + mcqQuestion.id);
                optionFiledID.addEventListener("click", () => {
                    let optionIdInMap = document.getElementById(`map_${mcqQuestion.id}`);
                    optionIdInMap.classList.remove("bg-secondary");
                    optionIdInMap.classList.add("bg-success");
                });
            });
        }
        /* Question Mapping part ends */

        // if(document.getElementById("mcqOp1_").checked) {
        //     console.log("ckecked");
        // }
        // else console.log("unchecked");


    // {{-- -----------------------------Frontend Script part for Timer collapse and expand # ends ----------------------------- --}}