    
      <!--Sign Up Form-->
      <div class="login-content signUp-content" id="signUp-content">
        <form action="php/signUp.php" method="POST" id="signUpForm" >
          <img class="avatar" src="./imgs/unknown.png" style="cursor:pointer"/> 
          <input type="file" name="pdp[]" id="pdp"  accept="image/png, image/jpeg, image/jpg, image/gif" style="display:none; " required>
          <h2 class="title">
            Welcome
          </h2>

          <script>

          </script>

          <div class="rowInput">

            <div class="input-div fullname">
              <div class="i">
                <i class="fas fa-user"></i>
              </div>
              <div class="div">
                <h5>Full Name</h5>
                <input type="text" class="input" name="fullName" id="fullname" />
                <span class="error"></span>
                <span class="success successForFullName"></span>              
              </div>
            </div>

            <div class="input-div username">
              <div class="i">
                <i class="fas fa-user"></i>
              </div>
              <div class="div">
                <h5>Username</h5>
                <input type="text" maxlength="15" class="input" name="username" id="username" />
                <span class="error"></span>
                <span class="success"></span>
              </div>
            </div>

          </div>

          <div class="rowInput">

            <div class="input-div gmail">
              <div class="i">
                <i class="fas fa-envelope-open-text"></i>
              </div>
              <div class="div">
                <h5>Gmail</h5>
                <input type="text" class="input" name="gmail" id="gmail" />
                <span class="error"></span>
                <span class="success"></span>
              </div>
            </div>

            <div class="input-div nationality">
              <div class="i">
                <i class="fas fa-globe-europe"></i>
              </div>
              <div class="div nationalite">
                <h5>Nationality</h5>
                <select   id="nationalite" name="nationalite" id="nationalite">
             
                </select>
                <!--<input type="text" class="input" id="nationalite" />-->
                <span class="error"></span>
                <span class="success"></span>
              </div>
            </div>

          </div>

          <div class="rowInput">

            <div class="input-div telephone">
              <div class="i">
                <i class="fas fa-mobile-alt"></i>
              </div>
              <div class="div">
                <h5>Phone Number</h5>
                <input type="tel" class="input" name="tel" id="tel" minlength="10"/>
                <span class="error"></span>
                <span class="success"></span>
               
              </div>
            </div>

            <div class="input-div birth">
              <div class="i">
                <i class="fas fa-birthday-cake"></i>
              </div>
              <div class="div .birth">
                <h5>Birthday</h5>
                <input type="date" class="input" name="birthday" id="birthday" min="1900-01-01" />
                <span class="error"></span>
                <span class="success"></span>
              </div>
            </div>
            
          </div>

          <div class="rowInput">

            <div class="input-div pwd">
              <div class="i">
                <i class="fas fa-lock"></i>
              </div>
              <div class="div">
                <h5>Password</h5>
                <input type="password" title="Minimum 8  characters in length
                Contains 3/4 of the following items:
                - Uppercase Letters
                - Lowercase Letters
                - Numbers
                - Symbols" class="input" name="pwd" id="pwd" />
                <span class="error"></span>
                <span class="success"></span>
              </div>
            </div>
            <div class="input-div cpwd">
              <div class="i">
                <i class="fas fa-lock"></i>
              </div>
              <div class="div">
                <h5>Confirm Password</h5>
                <input type="password" class="input" name="cpwd" id="cpwd" />
                <span class="error"></span>
                <span class="success"></span> 
              </div>
            </div>

          </div>

          <div class="submitBtn" style="margin-top:10px;">
            <input type="button" class="btn" id="inscrireBtn" value="Sign Up"  />
          </div>

          OR

          <div class="googleBtn">
            <button>
              <a href="#"
                ><i class="fab fa-google" style="margin-right:10px;"></i>Sign Up with Google
              </a>
            </button>
          </div>

          <div class="terms" style="margin-top: 6px;">
            <input type="checkbox" name="" id="checkTerms" style="margin-right: 6px;"> 
            <span class="termsLabel" style="text-align: center;">
            Creating an account means that you accept  <a href="../privacy.php" class="terms" target="_blank">our terms of use, privacy policy and default notification settings.</a> 
            </span>
          </div>

        </form>

      </div>