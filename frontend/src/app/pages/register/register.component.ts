import { Component, OnInit, ChangeDetectorRef } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { Profile } from 'src/app/core/models/profile.model';

//Icons
import { faCircleNotch } from '@fortawesome/free-solid-svg-icons';
import { UserService } from 'src/app/core/services/user.service';
import { takeUntil } from 'rxjs/operators';
import { Subject } from 'rxjs';
import { ToastrService } from 'ngx-toastr';


@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();

  faCircleNotch = faCircleNotch;


  isFormReady = false;
  isLoading = false;
  hasErrors = false;

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
      name: ["", Validators.compose([Validators.minLength(5), Validators.required])],
      email: ["", Validators.compose([Validators.email, Validators.required])],
      password: ["", Validators.compose([Validators.minLength(5), Validators.required])],
      password_confirmation: ["", Validators.compose([Validators.minLength(5), Validators.required])],
      firstName: ["", Validators.compose([Validators.minLength(5), Validators.required])],
      lastName: ["", Validators.compose([Validators.minLength(5), Validators.required])]
    });


    this.isFormReady = true;
  }


  prepare(): Profile {
    const formValue = this.form.value;

    let _model = new Profile();
    _model = Object.assign(_model, formValue);
    return _model;
  }

  onSubmit(e) {
    e.preventDefault();
    this.isLoading = true;
    const controls = this.form.controls;
    /** check form */
    if (this.form.invalid || this.form.controls["password"].value !== this.form.controls["password_confirmation"].value) {
      Object.keys(controls).forEach(controlName => controls[controlName].markAsTouched());
      this.isLoading = false;
      this.hasErrors = true;
      return;
    }
    this.hasErrors = false;


    const _model = this.prepare();




    this.userService.signup(_model).pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.form.reset();
        this.toastr.success("Successfully created! Redirecting to the login page in 3 seconds.");
        setTimeout(() => {
          this.router.navigate(["/login"]);
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
