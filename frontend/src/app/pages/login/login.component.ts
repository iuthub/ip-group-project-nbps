import { faCircleNotch } from '@fortawesome/free-solid-svg-icons';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { UserService } from 'src/app/core/services/user.service';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import {Location} from '@angular/common';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  
  
  //Icon
  faCircleNotch = faCircleNotch;
  
  //Status
  isFormReady = false;
  isLoading = false;
  
  form: FormGroup;
  
  
  
  constructor(
    private router: Router,
    private fb: FormBuilder,
    private userService: UserService,
    private toastr: ToastrService,
  ) { }

  ngOnInit(): void {
    
    this.createForm();
  }
  createForm() {

    this.form = this.fb.group({
      email: ["", Validators.compose([Validators.email, Validators.required])],
      password: ["", Validators.required],
    });


    this.isFormReady = true;
  }


  onSubmit(e) {
    e.preventDefault();
    this.isLoading = true;
    const controls = this.form.controls;
    
    if (this.form.invalid) {
      Object.keys(controls).forEach(controlName => controls[controlName].markAsTouched());
      this.isLoading = false;
      return;
    }


    const _model = {
      email: controls["email"].value,
      password:  controls["password"].value
    };




    this.userService.login(_model).pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.form.reset();
        this.toastr.success("Login successful! Redirecting to the home page.");
        
        
        
        //Set accessToken
        const curDate = new Date();
        const authorization = {
          expiryDate: curDate.setHours(curDate.getHours() + 1),
          token: res.access_token
        };
        window.localStorage.setItem("authorization", JSON.stringify(authorization));
        this.userService.authChange.next();
        
        setTimeout(() => {
          
          //Emit an event that authorization status changed
          
          this.router.navigate(["/"]);
        }, 3000);
      },
      null,
      () => {
        this.isLoading = false;
      }
    );
  }

  ngOnDestroy() {
    this.destroy.next();
    this.destroy.complete();
  }
}
