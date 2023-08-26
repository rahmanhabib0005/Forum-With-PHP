<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="signupmodalLabel">Signup for an iDiscuss Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form action="partials/_handleSignup.php" method="post">
                         <div class="modal-body">
                              <div class="mb-3">
                                   <label for="exampleInputEmail1" class="form-label">Username</label>
                                   <!-- <input type="email" class="form-control" name="signupEmail" id="signupEmail"
                                        aria-describedby="emailHelp"> -->
                                   <input type="text" class="form-control" name="signupEmail" id="signupEmail"
                                        aria-describedby="emailHelp">
                                   <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                   </div> -->
                              </div>
                              <div class="mb-3">
                                   <label for="exampleInputPassword1" class="form-label">Password</label>
                                   <input type="password" class="form-control" name="signuppassword" id="signuppassword">
                              </div>
                              <div class="mb-3">
                                   <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                   <input type="password" class="form-control" id="signupcpassword" name="signupcpassword">
                              </div>
                              <button type="submit" class="btn btn-primary">Signup</button>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>