unit Unit1;

interface

uses
  Windows, Messages, SysUtils, Classes, Graphics, Controls, Forms, Dialogs,
  ExtCtrls, StdCtrls, FileCtrl, Buttons, ComCtrls, ToolWin, OleCtrls,
  SHDocVw, ImgList, jpeg;

type
  TForm1 = class(TForm)
    Panel3: TPanel;
    Panel4: TPanel;
    Panel5: TPanel;
    Panel6: TPanel;
    Panel7: TPanel;
    Panel8: TPanel;
    DirectoryListBox1: TDirectoryListBox;
    FLB: TFileListBox;
    Panel11: TPanel;
    Panel12: TPanel;
    Panel13: TPanel;
    DriveComboBox1: TDriveComboBox;
    Panel14: TPanel;
    Panel15: TPanel;
    Panel1: TPanel;
    Panel2: TPanel;
    Panel10: TPanel;
    Panel9: TPanel;
    Panel16: TPanel;
    Metadados: TPageControl;
    TabSheet1: TTabSheet;
    TabSheet2: TTabSheet;
    TabSheet3: TTabSheet;
    Panel17: TPanel;
    wb: TWebBrowser;
    ToolBar1: TToolBar;
    ToolButton1: TToolButton;
    ToolButton2: TToolButton;
    ToolButton3: TToolButton;
    ToolButton4: TToolButton;
    image: TImageList;
    img: TImage;
    ED: TEdit;
    procedure ToolButton1Click(Sender: TObject);
    procedure FLBDblClick(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;

implementation

{$R *.DFM}

procedure TForm1.ToolButton1Click(Sender: TObject);
begin
        WB.Navigate('http://localhost');
end;

procedure TForm1.FLBDblClick(Sender: TObject);
var
        s: string;
        ext: string;
begin
        ext := AnsiLowerCase(copy(ed.text,length(ed.text)-2,3));
        if (ext = 'jpg') then
        begin
                Showmessage("OLA");
                img.Picture.LoadFromFile(ed.text);
                ed.text := 'JPG format';
        end;


end;

end.
