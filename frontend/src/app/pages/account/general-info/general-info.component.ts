import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/core/services/user.service';
import { Profile } from 'src/app/core/models/profile.model';
import { User } from 'src/app/core/models/user.model';

@Component({
  selector: 'app-general-info',
  templateUrl: './general-info.component.html',
  styleUrls: ['./general-info.component.scss']
})
export class GeneralInfoComponent implements OnInit {

  constructor(
    private userService: UserService,
  ) { }
  accountInfo: User
  ngOnInit(): void {
    
    this.userService.getUserInfo().subscribe(res=>{
      this.accountInfo = res;
      console.log(this.accountInfo.profile);
    })
    
  }

}
