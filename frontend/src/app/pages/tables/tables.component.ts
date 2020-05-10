import { Component, OnInit, TemplateRef } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { Table } from 'src/app/core/models/table.model';
import { Subject } from 'rxjs';
import { TableService } from 'src/app/core/services/table.service';
import { takeUntil } from 'rxjs/operators';


@Component({
  selector: 'app-tables',
  templateUrl: './tables.component.html',
  styleUrls: ['./tables.component.scss']
})
export class TablesComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  modalRef: BsModalRef;

  constructor(private modalService: BsModalService, private tableService: TableService) { }

  choosedTable: Number;
  choosedId: Number;
  tables: Table[];
  isLoading = true;
  status;
  time;
  date;

  ngOnInit(): void {

    this.tableService.getAllTables().pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.tables = res.tables;
        this.isLoading = false;
      })

  }

  book(id, date, time) {
    let data = {
      book_date: "2015-06-14",
      book_time: "11:25:00"
    }
    this.tableService.getTableStatus(id, data).pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.status = res;
        console.log(this.status);
      })
    console.log("Book table with id = " + id + " at " + date + " and " + time);

  }

  openModal(template: TemplateRef<any>, id: Number, number: Number) {
    this.choosedTable = number;
    this.choosedId = id;
    this.modalRef = this.modalService.show(template);
  }

}
