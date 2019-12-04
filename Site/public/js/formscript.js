                let fonction2 = document.querySelector("#autre"); //#commande_coating_fonction> option 

				console.log(fonction2);
				fonction2.addEventListener("click",inputtext);
				function inputtext() {
				   console.log('input');


                   let input = document.querySelector("#commande_autrefonction");
                   input.setAttribute('type', 'text');
                   input.setAttribute('class', 'form-control');
                }
                //				  let input = document.querySelector("#commande_autrefonction");

                
