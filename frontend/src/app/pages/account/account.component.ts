import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/core/services/user.service';
import { takeUntil } from 'rxjs/operators';
import { Subject } from 'rxjs';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-account',
  templateUrl: './account.component.html',
  styleUrls: ['./account.component.scss']
})
export class AccountComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  

  constructor(
    private userService: UserService,
    private router: Router,
    private toastr: ToastrService,
    ) { }

  ngOnInit(): void {
  }

  
  logout(e){
    e.preventDefault();
    this.toastr.warning("Logging out");
    this.userService.logout().pipe(takeUntil(this.destroy)).subscribe((res)=>{
      window.localStorage.removeItem("authorization");
      this.router.navigate(["/login"]);
      this.userService.authChange.next();
    })
  }
  
  
  ngOnDestroy() {
    this.destroy.next();
    this.destroy.complete();
  }
}
