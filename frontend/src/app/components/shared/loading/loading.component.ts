import { Component, OnInit } from '@angular/core';

import { faCircleNotch } from '@fortawesome/free-solid-svg-icons';


@Component({
  selector: 'app-loading',
  templateUrl: './loading.component.html',
  styleUrls: ['./loading.component.scss']
})
export class LoadingComponent implements OnInit {

  faCircleNotch = faCircleNotch;
  
  constructor() { }

  ngOnInit(): void {
  }

}
