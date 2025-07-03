     let name = document.querySelector(".name");
      let subject = document.querySelector(".subject");
      let message = document.querySelector(".message");
      let send = document.querySelector(".send-message");
      let username = document.querySelector(".username");
      let profile = document.querySelector(".profile");
      let popup = document.querySelector(".popup-wrapper");
      let getstarted = document.querySelector(".get-started");
      let span1 = document.querySelector(".span-1");
            let span2 = document.querySelector(".span-2");
                  let span3 = document.querySelector(".span-3");
                                    let love = document.querySelector("dotlottie-player");
                                    let loader = document.querySelector(".loader");
      let globaldata = null;
      let globalresponse = null;
        const audio=new Audio("romantic-effect.mp3");


      async function sendMessage() {
        try {
          const response = await fetch("api/send.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body:
              "message=" +
              message.value +
              "&subject=" +
              subject.value +
              "&name=" +
              name.value,
          });
          globaldata = await response.json();
          // globalresponse=await data.text()
        } catch (error) {
          console.error(error);
        }
      }

      async function getname() {
        try {
          const data = await fetch("api/get.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "getname=",
          });
          globalresponse = await data.json();
          // globalresponse=await data.text()
        } catch (error) {
          console.error(error);
        }
      }

      send.addEventListener("click", async () => {
        loader.style.display="flex";
        send.style.display="none"
        await sendMessage();
        if (globaldata.success == true) {
          console.log(globaldata);
        } else if (globaldata.success == false) {
          console.log(globaldata);
        }
loader.style.display="none";
        send.style.display="flex"
        await getname();
        if (globalresponse.success == true) {
          console.log(globalresponse);
          popup.style.opacity = "1";
                    popup.style.zIndex = 20;
          username.innerHTML = globalresponse.name;
          profile.innerHTML = username.innerHTML.slice(0, 1);
          span1.innerHTML="Download my CV to view my skills and my stack"
          span2.innerHTML="View my projects to know areas i've applied my skills"
          span3.innerHTML="Send me a message to get in touch with me"
          if(globalresponse.name=="tianah" || globalresponse.name=="Tianah" || globalresponse.name=="christy" || globalresponse.name=="Christy" || globalresponse.name=="odun"|| globalresponse.name=="odunayo" || globalresponse.name=="Odun" || globalresponse.name=="Odunayo" || globalresponse.name=="anike" || globalresponse.name=="Anike" || globalresponse.name=="christianah" || globalresponse.name=="Christianah"){
            love.style.display="flex";
            span1.innerHTML="You're my girlfriend for the day"
            span2.innerHTML="You've seen all of me already so why not"
            span3.innerHTML="I'm not there to give you a massage so just smile hun."
            audio.play()
            audio.loop=true;
          }

        } else if (globalresponse.success == false) {
          console.log(globalresponse);
        }
      });

      getstarted.addEventListener("click", () => {
          popup.style.opacity = 0;
                      love.style.display="none";
                              popup.style.zIndex = -10;
                              audio.pause();
                              audio.currentTime=0;
      });