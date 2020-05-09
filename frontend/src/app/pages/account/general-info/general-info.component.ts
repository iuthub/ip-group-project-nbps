import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/core/services/user.service';

@Component({
  selector: 'app-general-info',
  templateUrl: './general-info.component.html',
  styleUrls: ['./general-info.component.scss']
})
export class GeneralInfoComponent implements OnInit {

  constructor(
    private userService: UserService,
  ) { }

  ngOnInit(): void {
    
    this.userService.getUserInfo().subscribe(res=>{
      console.log(res);
    })
    
  }

}
