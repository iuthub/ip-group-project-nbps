import { Component, OnInit, TemplateRef } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { Table } from 'src/app/core/models/table.model';
import { Subject } from 'rxjs';
import { TableService } from 'src/app/core/services/table.service';
import { takeUntil, isEmpty } from 'rxjs/operators';
import { HttpParams } from '@angular/common/http';
import { BookingService } from 'src/app/core/services/booking.service';
import { ToastrService } from 'ngx-toastr';


@Component({
  selector: 'app-tables',
  templateUrl: './booking.component.html',
  styleUrls: ['./booking.component.scss']
})
export class BookingComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  modalRef: BsModalRef;

  constructor(
    private modalService: BsModalService,
    private tableService: TableService,
    private bookingService: BookingService,
    private toastr: ToastrService
  ) { }

  tables: Table[];
  isLoading = true;
  hasErrors = false;
  errorMsg = '';
  status;
  time;
  date;
  choosedTable;

  ngOnInit(): void {

    this.tableService.getAllTables().pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.tables = res.tables;
        this.isLoading = false;
      })

  }
  formatDate(date) {
    let d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

    if (month.length < 2)
      month = '0' + month;
    if (day.length < 2)
      day = '0' + day;

    return [year, month, day].join('-');
  }

  formatTime(time) {
    let d = new Date(time),
      hours = '' + (d.getHours()),
      minutes = '' + d.getMinutes(),
      seconds = '' + d.getSeconds();
    if (hours.length < 2)
      hours = '0' + hours;
    if (minutes.length < 2)
      minutes = '0' + minutes;
    if (seconds.length < 2)
      seconds = '0' + seconds;
    return [hours, minutes, seconds].join(':');
  }
  book(table, date, time) {
    if (!date || !time) {
      this.hasErrors = true;
      this.errorMsg = "Please enter all fields"
    } else {
      let params = new HttpParams();
      params = params.append('book_date', this.formatDate(date));
      params = params.append('book_time', this.formatTime(time));
      this.tableService.getTableStatus(table.id, params).pipe(takeUntil(this.destroy)).subscribe(
        (res) => {
          this.status = res;
          if (this.status.free) {
            let data = {
              book_date: this.formatDate(date),
              book_time: this.formatTime(time),
              people_count: table.people_count
            }
            this.bookingService.setBookOfTableById(table.id, data).pipe(takeUntil(this.destroy)).subscribe(
              (res) => {
                this.toastr.success("Table #" + table.number + " was booked");
                this.modalRef.hide();
              }
            );
          } else {
            this.hasErrors = true;
            this.errorMsg = "Table #" + table.number + " at this time is busy.";
          }
        });
    }

  }

  openModal(template: TemplateRef<any>, table: {}) {
    this.choosedTable = table;
    this.modalRef = this.modalService.show(template);
  }

  ngOnDestroy() {
    this.destroy.next();
    this.destroy.complete();
  }
}
