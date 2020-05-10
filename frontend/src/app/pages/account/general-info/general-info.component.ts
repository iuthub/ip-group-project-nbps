import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/core/services/user.service';
import { Profile } from 'src/app/core/models/profile.model';
import { User } from 'src/app/core/models/user.model';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';

@Component({
  selector: 'app-general-info',
  templateUrl: './general-info.component.html',
  styleUrls: ['./general-info.component.scss']
})
export class GeneralInfoComponent implements OnInit {

  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();

  constructor(
    private userService: UserService,
  ) { }
  accountInfo;
  isLoading = true;
  ngOnInit(): void {
    this.userService.getUserInfo().pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.accountInfo = res;
        this.isLoading = false;
        console.log(this.accountInfo);
      })

  }

}
