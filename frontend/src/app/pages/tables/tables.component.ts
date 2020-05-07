import { Component, OnInit, TemplateRef } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';

@Component({
  selector: 'app-tables',
  templateUrl: './tables.component.html',
  styleUrls: ['./tables.component.scss']
})
export class TablesComponent implements OnInit {
  modalRef: BsModalRef;
  constructor(private modalService: BsModalService) { }

  choosedId: Number;
  tables = [
    { id: 1 },
    { id: 2 },
    { id: 3 },
    { id: 4 },
  ];

  ngOnInit(): void {
  }

  openModal(template: TemplateRef<any>, id: Number) {
    this.choosedId = id;
    this.modalRef = this.modalService.show(template);
  }

}
